<?php

namespace App\Http\Livewire\Admin\Presidency\Permissions;

use App\Models\Permission;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Edit extends Component
{
    public Permission $permission;
    public $name;
    public $label;

    protected function rules()
    {
        return [
            'name' => ['required', 'string', 'min:4', 'max:255', Rule::unique('permissions')->ignore($this->permission->id)],
            'label' => ['required', 'string', 'min:4', 'max:255']
        ];
    }

    public function mount()
    {
        $this->fill([
            'name' => $this->permission->name,
            'label' => $this->permission->label,
        ]);
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function updatePermission()
    {
        $validated = $this->validate();
        $permission = $this->permission->update($validated);

        //TODO ALERT

        return redirect(route('admin.presidency.permissions.all'));
    }

    public function render()
    {
        return view('livewire.admin.presidency.permissions.edit');
    }
}
