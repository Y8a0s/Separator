<?php

namespace App\Http\Livewire\Admin\Presidency\Admins;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class All extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $readyToLoad = false;
    protected $query;
    public $search;
    public $filterBy = 'all';

    public function __construct()
    {
        $this->query = User::latest()->where('isSuperUser', 0)->where('isAdmin', 1);
    }

    public function searchAdmins()
    {
        $this->query = User::filterOrSearchUsers($this->filterBy , $this->search , $this->search);
    }
    
    public function loadAdminsData()
    {
        if ($this->search != null || $this->filterBy != 'all')
            $this->searchAdmins();
        $this->readyToLoad = true;
    }

    public function deleteAdmin(User $user)
    {
        if (!is_null($this->user->image))
                if (Storage::disk('public')->exists($user->image))
                    Storage::disk('public')->delete($user->image);
                    
        $user->delete();
    }

    public function dismissAdmin(User $user)
    {
        $user->permissions()->detach();
        $user->isAdmin = 0;
        $user->save();
    }
    
    public function render()
    {
        $admins = $this->query->paginate(10);
        return view('livewire.admin.presidency.admins.all' , compact('admins'));
    }
}
