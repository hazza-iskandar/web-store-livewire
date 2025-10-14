<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

#[\Livewire\Attributes\Title('Login Account')]
class SignIn extends Component
{
    public
        $email = "",
        $password = "",
        $remember = false;

    public function resetField($field)
    {
        $this->resetErrorBag($field);
    }

    public function autenticate()
    {
        $validated = $this->validate(
            [
                'email' => 'required|email|email:dns',
                'password' => 'required|min:8|max:16',
                'remember' => 'boolean'
            ],
            [
                'email.required' => 'Email harus diisi.',
                'email.email' => 'Email tidak valid.',
                'email.dns' => 'Domain email tidak valid.',

                'password.required' => 'Password harus diisi.',
                'password.min' => 'Password minimal 8 karakter.',
                'password.max' => 'Password maksimal 16 karakter.',

                'remember.boolean' => 'Pilihan "ingat saya" tidak valid'
            ]
        );

        $credential = [
            'email' => $validated['email'],
            'password' => $validated['password']
        ];

        if(Auth::attempt($credential, $this->remember)){
            $this->redirectRoute('home', navigate:true);
        }else{
            $this->dispatch('notify', status:'failed', message:"login gagal silahkan ulangi");
            $this->redirectRoute('login', navigate:true);
        }
    }

    public function render()
    {
        return view('livewire.auth.sign-in');
    }
}
