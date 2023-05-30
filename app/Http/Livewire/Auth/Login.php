<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email, $password, $isModal = true;

    public function mount($isModal = true)
    {
        $this->isModal = $isModal;
        session(['url.intended' => url()->previous()]);
    }

    public function submit()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::attempt([
            'email' => $this->email,
            'password' => $this->password
        ])) {
            $user = Auth::user();
            if ($user->role != 'user') {
                Auth::logout();
                return $this->addError('email', 'Anda tidak diizinkan masuk');
            }

            if (session()->has('url.intended')) {
                return redirect(session('url.intended'));
            } else {
                return redirect("/");
            }
        } else {
            return $this->addError('email', 'Email / Password anda salah');
        }
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
