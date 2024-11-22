<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;

class Logout extends Component
{
    public function Logout()
    {
        auth()->logout();
        $this->dispatchBrowserEvent('refresh_page'); // in the app.blade.php
    }

    public function render()
    {
        return view('livewire.auth.logout');
    }
}
