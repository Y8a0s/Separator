<?php

namespace App\Http\Livewire\Admin\Products;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Edit extends Component
{
    use WithFileUploads;

    public Product $product;
    public $title, $brand, $build_model, $description, $price, $available = 0,  $images = [], $alt;

    protected $rules = [
        'title' => ['required', 'string', 'min:3', 'max:255'],
        'brand' => ['nullable', 'string', 'min:3', 'max:255'],
        'build_model' => ['nullable', 'numeric', 'min:1000', 'max:9999'],
        'description' => ['required', 'string', 'min:4'],
        'price' => ['nullable', 'numeric'],
        'available' => ['nullable', 'boolean'],
        'images' => ['nullable', 'array', 'max:5'],
        'images.*' => ['nullable', 'image', 'max:5000'],
        'alt' => ['nullable', 'string', 'min:3', 'max:255']
    ];

    public function mount()
    {
        $this->fill([
            'title' => $this->product->title,
            'brand' => $this->product->brand,
            'build_model' => $this->product->build_model,
            'description' => $this->product->description,
            'price' => $this->product->price,
            'available' => $this->product->available,
            'alt' => $this->product->alt
        ]);
    }

    public function updated($property)
    {
        if ($property != 'images')
            $this->validateOnly($property);
    }

    public function updatedImages()
    {
        $this->validate([
            'images' => ['nullable', 'array', 'max:5'],
            'images.*' => ['nullable', 'image', 'max:3000']
        ]);
    }

    public function updateProduct()
    {
        $validated = $this->validate();

        if (collect($validated['images'])->count()) {
            foreach ($validated['images'] as $key => $image) {
                $image_path = $this->UpdateImage($image);
                $validated['images'][$key] = $image_path;
            }
            $validated['images'] = json_encode($validated['images']);
        } else {
            $validated['images'] = null;
        }

        if (is_null($validated['images']))
            unset($validated['images']);

        if ($validated['price'] == '')
            $validated['price'] = null;

        $this->product->update($validated);
        $this->product->user->id != auth()->user()->id ? $this->product->update(['user_id' => auth()->user()->id]) : '';

        // TODO ALERT

        return redirect(route('admin.products.all'));
    }

    public function ClearAllImages()
    {
        $this->product->update(['images' => null]);
        $this->reset('images');
    }

    public function render()
    {
        return view('livewire.admin.products.edit');
    }

    ////////////////////////////////// Functions //////////////////////////////////

    public function UpdateImage($image)
    {
        $old_images = json_decode($this->product->images);
        if (collect($old_images)->count())
            foreach ($old_images as $old_img)
                if (Storage::exists($old_img))
                    dd(1);
        // Storage::delete($old_img);

        $year = jdate(now())->getYear();
        $month = jdate(now())->getMonth();
        $day = jdate(now())->getDay();

        $dir = "images/products/$year/$month/$day";
        $name = Str::random(5) . '_' . $image->getClientOriginalName();

        $image->storeAs($dir, $name);

        return "$dir/$name";
    }
}
