<?php

namespace App\Http\Livewire\Admin\Presidency\Admins;

use App\Models\User;
use Livewire\Component;

class Permissions extends Component
{
    public User $admin;
    public $permissions = [];

    protected $rules = [
        'permissions' => ['nullable' , 'exists:permissions,id'],
    ];

    public function mount()
    {
        if($this->admin->permissions()->count())
        $this->fill([
            'permissions' => $this->admin->permissions()->pluck('id')
        ]);
    }

    public function updated($permissions)
    {
        $this->validateOnly($permissions);
    }

    public function setPermissions()
    {
        $validated = $this->validate();
        $this->admin->permissions()->sync($validated['permissions']);

        //TODO ALERT

        return redirect(route('admin.presidency.admins.all'));
    }

    public function render()
    {
        return view('livewire.admin.presidency.admins.permissions');
    }
}
