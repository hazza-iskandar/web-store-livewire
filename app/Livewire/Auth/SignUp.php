<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;

#[\Livewire\Attributes\Title('Register Account')]
class SignUp extends Component
{
    public
        $username = "",
        $email = "",
        $password = "";

    public function resetField($field)
    {
        $this->resetErrorBag($field);
    }

    public function register()
    {
        $validated = $this->validate(
            [
                'username' => 'required|min:3|max:100',
                'email' => 'required|email|unique:users,email|email:dns',
                'password' => 'required|min:8|max:16',
            ],
            [
                'username.required' => 'Username harus diisi.',
                'username.min' => 'Username minimal 3 karakter.',
                'username.max' => 'Username maksimal 100 karakter.',

                'email.required' => 'Email harus diisi.',
                'email.email' => 'Email tidak valid.',
                'email.unique' => 'Email sudah digunakan.',
                'email.dns' => 'Domain email tidak valid.',

                'password.required' => 'Password harus diisi.',
                'password.min' => 'Password minimal 8 karakter.',
                'password.max' => 'Password maksimal 16 karakter.',
            ]
        );

        // sudah otomatis hash oleh model
        $user = User::create($validated);

        if($user){
            $this->dispatch('notify', status:'success', message:'Anda berhasil daftar silahkan login');
            // reset input
            $this->reset(['username', 'email', 'password']);
        }else{
            $this->dispatch('notify', status:'failed', message:'Anda gagal daftar silahkan daftar ulang');
        }
    }

    public function render()
    {
        return view('livewire.auth.sign-up');
    }
}
