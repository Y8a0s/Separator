<?php

namespace App\Http\Livewire\Admin\Presidency\Permissions;

use App\Models\Permission;
use Livewire\Component;

class All extends Component
{
    public $readyToLoad = false;

    public function loadPermissionsData()
    {
        $this->readyToLoad = true;
    }

    public function deletePermission(Permission $permission)
    {
        $permission->delete();
    }

    public function render()
    {
        $permissions = Permission::all();
        return view('livewire.admin.presidency.permissions.all' , compact('permissions'));
    }
}
