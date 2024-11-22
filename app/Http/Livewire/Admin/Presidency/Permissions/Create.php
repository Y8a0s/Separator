<?php

namespace App\Http\Livewire\Admin\Presidency\Permissions;

use App\Models\Permission;
use Livewire\Component;

class Create extends Component
{
    public $name;
    public $label;

    protected $rules = [
        'name' => ['required' , 'string' , 'min:4' , 'max:255' , 'unique:permissions,name'],
        'label' => ['required' , 'string' , 'min:4' , 'max:255']
    ];

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function storePermission()
    {
        $validated = $this->validate();
        $permission = Permission::create($validated);

        //TODO ALERT

        return redirect(route('admin.presidency.permissions.all'));
    }

    public function render()
    {
        return view('livewire.admin.presidency.permissions.create');
    }
}
