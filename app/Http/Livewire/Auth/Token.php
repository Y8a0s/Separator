<?php

namespace App\Http\Livewire\Auth;

use App\Models\ActiveCode;
use App\Models\User;
use App\Notifications\ActiveCodeNotification;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Component;

use function PHPUnit\Framework\returnSelf;

class Token extends Component
{
    use AuthorizesRequests;

    public $user;
    public $token; //code that user entered in input
    protected $code; //new available correct code

    protected $rules = [
        'token' => ['required' , 'numeric' , 'min:6' , 'min_digits:6'] 
    ];

    protected $messages = [
        'token.min_digits' => 'طول :attribute نمیتواند کمتر از :min کاراکتر باشد.'
    ];

    protected $validationAttributes = [
        'token' => 'کد'
    ];

    protected $listeners = ['sendAgain' => 'resendToken'];

    public function mount(Request $request)
    {
        if (!$request->session()->has('auth')) {
            return redirect(route('auth.login'));
        }

        $request->session()->reflash();

        $user_id = (int) $request->session()->get('auth.user_id');
        $this->user = User::find($user_id);
    }

    public function updated($token)
    {
        $this->validateOnly($token);
    }

    public function Token(Request $request)
    {
        $this->validate();

        $status = ActiveCode::verifyCode($this->token, $this->user);

        if (!$status) {
            return $this->addError('token', 'کد وارد شده نادرست می باشد');
        }

        if (auth()->loginUsingId($this->user->id)) {
            $this->user->activeCode()->delete();
            if ($this->user->verified == 0) {
                $this->user->verified = 1;
                $this->user->save();
            }

            return redirect(route('home'));
        }

        return redirect(route('auth.login'));
    }

    public function resendToken(Request $request)
    {
        $executed = RateLimiter::attempt(
            $request->ip, // special key
            1, // perMinutes
            function () {
                $this->code = ActiveCode::generateCode($this->user);
                $this->user->notify(new ActiveCodeNotification($this->code));
                $this->emit('timer');
            },
            60, //decayRateSeconds
        );

        if (!$executed)
            return $this->emit('simpleToast', 'danger', 'درخواست بیش از حد مجاز', 'لطفا پس از ' . env("SMS_RESEND_CODE_TIME") . ' دقیقه دیگر مجددا تلاش نمایید');
    }

    public function render()
    {
        return view('livewire.auth.token');
    }
}
