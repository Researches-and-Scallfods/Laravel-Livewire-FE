<?php

namespace App\Http\Livewire\Auth;

use App\Models\PasswordResetToken;
use Livewire\Component;
use Illuminate\Support\Str;

class ForgotPassword extends Component
{
    public $email;

    public function submit()
    {
        $this->validate([
            'email' => 'required|exists:users,email'
        ]);

        $check = PasswordResetToken::where('email', $this->email)
            ->first();
        $token = Str::random(16);

        if ($check) {
            PasswordResetToken::where('email', $this->email)
                ->update([
                    'token' => $token
                ]);
        } else {
            PasswordResetToken::create([
                'email' => $this->email,
                'token' => $token,
            ]);
        }

        $this->addError('success', 'Email telah dikirimkan');
    }

    public function render()
    {
        return view('livewire.auth.forgot-password');
    }
}
