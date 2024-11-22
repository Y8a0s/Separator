<?php

namespace App\Http\Livewire\Admin\Products;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;


class Create extends Component
{
    use WithFileUploads;

    public $title, $brand, $build_model, $description, $price, $available = 0,  $images = [], $alt;

    protected $rules = [
        'title' => ['required', 'string', 'min:3', 'max:255'],
        'brand' => ['required', 'string', 'min:3', 'max:255'],
        'build_model' => ['nullable', 'numeric', 'min:1000', 'max:9999'],
        'description' => ['required', 'string', 'min:4'],
        'price' => ['nullable', 'numeric'],
        'available' => ['nullable', 'boolean'],
        'images' => ['nullable', 'array', 'max:5'],
        'images.*' => ['nullable', 'image', 'max:3000'],
        'alt' => ['nullable', 'string', 'min:3', 'max:255']
    ];


    public function updated($property)
    {
        if ($property != 'images')
            $this->validateOnly($property);
    }

    public function updatedImages()
    {
        $this->validate([
            'images' => ['nullable', 'array', 'max:5'],
            'images.*' => ['nullable', 'image', 'max:5000']
        ]);
    }

    public function storeProduct()
    {
        $validated = $this->validate();
        if (collect($validated['images'])->count()) {
            foreach ($validated['images'] as $key => $image) {
                $image_path = $this->StoreImage($image , $this->title . ' ' . $this->brand);
                $validated['images'][$key] = $image_path;
            }
            $validated['images'] = json_encode($validated['images']);
        } else {
            $validated['images'] = null;
        }

        User::find(auth()->user()->id)->products()->create($validated);
        // TODO ALERT

        return redirect(route('admin.products.all'));
    }

    public function ClearAllImages()
    {
        $this->reset('images');
    }

    public function render()
    {
        return view('livewire.admin.products.create');
    }

    ////////////////////////////////////////////////////////////////////////////////

    public function StoreImage($image, $lastDir = null)
    {
        if (is_null($lastDir)){
            $dir = "images/products";
        }else{
            $dir = "images/products/$lastDir";
        }

        $name = Str::random(5) . '_' . $image->getClientOriginalName();

        $image->storeAs($dir, $name);

        return "$dir/$name";
    }
}
