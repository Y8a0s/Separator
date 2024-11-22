<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class All extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $readyToLoad = false;
    protected $query;
    public $search;
    public $filterBy = 'all';

    public function __construct()
    {
        $this->query = User::latest()->where('isSuperUser', 0)->where('isAdmin', 0);
    }

    public function searchUsers()
    {
        $this->query = User::filterOrSearchUsers($this->filterBy, $this->search, $this->search);
        $this->query = $this->query->where('isSuperUser', 0)->where('isAdmin', 0);
    }

    public function loadUsersData()
    {
        if ($this->search != null || $this->filterBy != 'all')
            $this->searchUsers();
        $this->readyToLoad = true;
    }

    public function deleteUser(User $user)
    {
        $this->authorize('delete-users');

        if (!is_null($this->user->image))
                if (Storage::disk('public')->exists($user->image))
                    Storage::disk('public')->delete($user->image);
                    
        $user->delete();
    }

    public function setAdmin(User $user)
    {
        $this->authorize('super.user');
        $user->isAdmin = 1;
        $user->save();
    }

    public function render()
    {
        $users = $this->query->paginate(10);
        return view('livewire.admin.users.all', compact('users'));
    }
}
