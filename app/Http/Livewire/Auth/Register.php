<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Register extends Component
{
    public $nama, $email, $password, $konfirmasi_password, $isModal = true;

    public function mount($isModal = true)
    {
        $this->isModal = $isModal;
    }

    public function submit()
    {
        $this->validate([
            'nama' => 'required|min:5',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8|same:konfirmasi_password'
        ]);

        $user = User::create([
            'username' => $this->email,
            'email' => $this->email,
            'display_name' => $this->nama,
            'role' => 'user',
            'password' => bcrypt($this->password)
        ]);

        Auth::attempt([
            'email' => $this->email,
            'password' => $this->password
        ]);

        return redirect("/");
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
