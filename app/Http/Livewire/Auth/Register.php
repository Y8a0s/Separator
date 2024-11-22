<?php

namespace App\Http\Livewire\Auth;

use App\Models\ActiveCode;
use App\Models\User;
use App\Notifications\ActiveCodeNotification;
use Illuminate\Http\Request;
use Livewire\Component;

class Register extends Component
{
    public $name;
    public $last_name;
    public $phone;
    public $password;
    public $password_confirmation;

    protected $rules = [
        'name' => ['required' , 'string' , 'max:255'],
        'last_name' => ['required' , 'string' , 'max:255'],
        'phone' => ['required' , 'regex:/^09\d{9}$/' , 'unique:users,phone'],
        'password' => ['required', 'string', 'min:8'],
        'password_confirmation' => ['required', 'same:password'],
    ];

    protected function updated($property)
    {
        $this->validateOnly($property);
    }

    public function Register(Request $request)
    {
        $validated = $this->validate();
        $validated['password'] = bcrypt($validated['password']);
        unset($validated['password_confirmation']);

        $user = User::create($validated);
        $code = ActiveCode::generateCode($user);

        $request->session()->flash('auth', [
            'user_id' => $user->id,
            'remember' => $request->has('remember')
        ]);

        $user->notify(new ActiveCodeNotification($code));

        return redirect(route('auth.phone.token'));
    }
    
    public function render()
    {
        $this->seo()
            ->setTitle('عضویت')
            ->opengraph()->setUrl(url()->current());

        return view('livewire.auth.register');
    }
}
