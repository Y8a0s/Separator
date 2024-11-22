<?php

namespace App\Http\Livewire\Auth;

use App\Models\ActiveCode;
use App\Models\User;
use App\Notifications\ActiveCodeNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Vite;
use Livewire\Component;

class Login extends Component
{
    public $phone;
    public $code;
    public $password;

    protected $rules = [
        'phone' => ['required', 'regex:/^09\d{9}$/', 'exists:users,phone'],
        'password' => ['required']
    ];

    public function updated($phone)
    {
        $this->validateOnly($phone);
    }

    public function Login(Request $request)
    {
        $validated = $this->validate();

        $user = User::wherePhone($validated['phone'])->first();

        if (!$user->verified) {
            $code = ActiveCode::generateCode($user);

            $request->session()->flash('auth', [
                'user_id' => $user->id,
                'remember' => $request->has('remember')
            ]);

            $user->notify(new ActiveCodeNotification($code));

            return redirect(route('auth.phone.token'));
        }

        if (Auth::attempt($validated)) {
            $request->session()->regenerate();

            return redirect()->intended(route('home'));
        }else{
            return $this->addError('password', 'شماره موبایل و رمز عبور با هم مطابقت ندارند. ');
        }
    }

    public function render()
    {
        $this->seo()
            ->setTitle('ورود')
            ->opengraph()->setUrl(url()->current());

        return view('livewire.auth.login');
    }
}
