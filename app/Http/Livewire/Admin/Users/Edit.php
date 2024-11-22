<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Edit extends Component
{
    public User $user;
    public $name;
    public $last_name;
    public $phone;
    public $password;
    public $password_confirmation;
    public $verified;

    public function mount()
    {
        $this->fill([
            'name' => $this->user->name,
            'last_name' => $this->user->last_name,
            'phone' => $this->user->phone,
            'verified' => $this->user->verified
        ]);
    }

    protected function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'regex:/^09\d{9}$/', Rule::unique('users')->ignore($this->user->id)],
            'password' => ['nullable', 'string', 'min:8'],
            'password_confirmation' => ['nullable', 'same:password'],
            'verified' => ['boolean']
        ];
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function updateUser()
    {
        $validated = $this->validate();
        
        if ($validated['password'] && $validated['password_confirmation']) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }
        unset($validated['password_confirmation']);
        
        $this->user->update($validated);
        $this->emit('toastAlert', 'success', 'کاربر با موفقیت ویرایش شد'); //this event is in admin app.blade.php

        return $this->user->isAdmin
            ? redirect(route('admin.presidency.admins.all'))->with('toastAlert', ['icon' => 'success', 'title' => 'کاربر با موفقیت ویرایش شد']) //session flash for toast alert in next page
            : redirect(route('admin.users.all'))->with('toastAlert', ['icon' => 'success', 'title' => 'کاربر با موفقیت ویرایش شد']);
    }

    public function render()
    {
        return view('livewire.admin.users.edit');
    }
}
