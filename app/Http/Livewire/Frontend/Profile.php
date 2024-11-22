<?php

namespace App\Http\Livewire\Frontend;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;


class Profile extends Component
{
    use WithFileUploads;

    public $user;
    public $image;
    public $isImageUpdated = false;
    public $name;
    public $last_name;
    // public $phone;

    protected $rules = [
        'name' => ['required', 'string', 'min:3', 'max:255'],
        'last_name' => ['required', 'string', 'min:3', 'max:255'],
        'image' => ['image', 'max:5120', 'nullable']
        // 'phone' => ['required' , 'regex:/^(?:0|98|\+98|\+980|0098|098|00980)?(9\d{9})$/' , 'unique:users,phone']
    ];

    protected $validationAttributes = [
        'name' => 'نام',
        'last_name' => 'نام خانوادگی',
        'image' => 'فایل'
    ];

    public function __construct()
    {
        $this->user = User::find(auth()->user()->id);
        $this->image = $this->user->image;
        $this->name = $this->user->name;
        $this->last_name = $this->user->last_name;
        // $this->phone = $this->user->phone;
    }

    public function mount()
    {
        $this->fill([
            'name' => $this->name,
            'last_name' => $this->last_name,
            // 'phone' => $this->phone
        ]);
    }

    public function updated($propery)
    {
        $this->validateOnly($propery);
    }

    public function updatedImage()
    {
        $this->isImageUpdated = true;
    }

    public function deleteImage()
    {
        $this->image = null;
        $this->isImageUpdated = true;
    }

    public function editProfile()
    {
        if ($this->isImageUpdated) { // when $this->image not updated , path of old image saved in this as string
            $validated = $this->validate();

            if (!is_null($validated['image'])) {
                $image_path = $this->StoreImage($this->image);
                $validated['image'] = $image_path;
            }

            if (!is_null($this->user->image))
                if (Storage::disk('public')->exists($this->user->image))
                    Storage::disk('public')->delete($this->user->image);

        } else { // when image is not updated we get the error in validation because the old image path is saved in $this->image and thats not file
            $validated = $this->validateOnly('name');
            $validated += $this->validateOnly('last_name');
        }

        $this->user->update($validated);
        $this->emit('simpleToast', 'success', 'ویرایش موفق', 'تغییرات مورد نظر با موفقیت به روی پروفایل شما اعمال شد');
    }

    public function render()
    {
        $this->seo()
            ->setTitle('پروفایل')
            ->opengraph()->setUrl(url()->current());
       
        return view('livewire.frontend.profile');
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function StoreImage($image)
    {
        $year = jdate(now())->getYear();
        $month = jdate(now())->getMonth();
        $day = jdate(now())->getDay();

        $dir = "images/users/$year/$month/$day";
        $name = Str::random(5) . '_' . $image->getClientOriginalName();

        $image->storeAs($dir, $name);

        return "$dir/$name";
    }
}
