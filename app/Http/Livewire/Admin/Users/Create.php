<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;

use function PHPUnit\Framework\isNull;

class Create extends Component
{
    public $name;
    public $last_name;
    public $phone;
    public $password;
    public $password_confirmation;
    public $verified = 0;

    protected $rules = [
        'name' => ['required' , 'string' , 'max:255'],
        'last_name' => ['required' , 'string' , 'max:255'],
        'phone' => ['required' , 'regex:/^09\d{9}$/' , 'unique:users,phone'],
        'password' => ['required', 'string', 'min:8'],
        'password_confirmation' => ['required', 'same:password'],
        'verified' => ['boolean']
    ];

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function storeUser()
    {
        $validated = $this->validate();
        $validated['password'] = bcrypt($validated['password']);
        unset($validated['password_confirmation']);

        User::create($validated);
 
        $this->emit('toastAlert' , 'success' , 'کاربر جدید با موفقیت ایجاد شد'); //this event is in admin app.blade.php
        return redirect(route('admin.users.all'));
    }

    public function render()
    {
        return view('livewire.admin.users.create');
    }
}
