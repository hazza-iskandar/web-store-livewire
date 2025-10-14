<?php

namespace App\Livewire\Account;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

#[\Livewire\Attributes\Layout('components.layouts.app')]
class Profile extends Component
{
    public
        $username = "",
        $email = "",
        $fullname = "",
        $phone = "",
        $img_profile = "",
        $alamat = "",
        $adress = "",
        $password = "",
        $newPasword = "";

    public $user; 

    public function mount()
    {
        $user = User::find(Auth::user()->id);
        if (!$user) {
            return view('livewire.404');
        }
        $this->user = $user;

        // nilai default
        $this->username = $user->username;
        $this->email = $user->email;

    }
    public function render()
    {
        return view('livewire.account.profile');
    }
}
