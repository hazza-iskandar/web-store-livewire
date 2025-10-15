<?php

namespace App\Livewire\Account;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Profile as ProfileModel;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\WithFileUploads;

#[\Livewire\Attributes\Layout('components.layouts.app')]
class Profile extends Component
{
    // buat preview img
    use WithFileUploads;

    public
        $username = "",
        $email = "",
        $fullname = "",
        $phone = "",
        $img_profile = "",
        $adress = "",
        $password,
        $newPassword;

    public $user;

    public function mount()
    {
        $user = User::find(Auth::user()->id);
        if (!$user) {
            return view('livewire.404');
        }
        $this->user = $user;

        // nilai default
        $this->username = $user->username ?? '';
        $this->email = $user->email ?? '';
        $this->fullname = $user->profile->fullname ?? '';
        $this->phone = $user->profile->phone ?? '';
        $this->adress = $user->profile->adress ?? '';
    }

    // public function deletTmpPrev()
    // {
    //     if(Storage::disk('local'))->exi
    // }

    public function resetField($field)
    {
        $this->resetErrorBag($field);
    }

    // rules untuk validate 
    public function rules()
    {
        $rules = [
            'username'    => 'required|string|min:3|max:100',
            'fullname'    => 'required|string|min:3|max:150',
            'phone'       => 'required|string|min:10|max:15|regex:/^08[0-9]{8,11}$/',
            'img_profile' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // optional upload
            'adress'      => 'nullable|string|max:255',
        ];

        if ($this->email != $this->user->email) {
            $rules['email'] = 'required|email|unique:users,email|email:dns';
        } else {
            $rules['email'] = 'required|email';
        }

        if ($this->password && $this->newPassword) {
            $rules['password'] = 'nullable|string|min:6|max:16';
            $rules['newPassword'] = 'nullable|string|min:6|max:16|different:password';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'username.required'    => 'Username harus diisi.',
            'username.min'         => 'Username minimal 3 karakter.',
            'username.max'         => 'Username maksimal 100 karakter.',

            'email.required'       => 'Email harus diisi.',
            'email.email'          => 'Email tidak valid.',
            'email.unique'         => 'Email sudah digunakan.',

            'fullname.required'    => 'Nama lengkap harus diisi.',
            'fullname.min'         => 'Nama lengkap minimal 3 karakter.',
            'fullname.max'         => 'Nama lengkap maksimal 150 karakter.',

            'phone.required'       => 'Nomor telepon harus diisi.',
            'phone.min'            => 'Nomor telepon terlalu pendek.',
            'phone.max'            => 'Nomor telepon terlalu panjang.',
            'phone.regex'           => 'Nomor telepon harus diawali dengan 08 dan hanya berisi angka.',

            'img_profile.image'    => 'File harus berupa gambar.',
            'img_profile.mimes'    => 'Format gambar harus JPG, JPEG, atau PNG.',
            'img_profile.max'      => 'Ukuran gambar maksimal 2MB.',


            'adress.max'           => 'Alamat maksimal 255 karakter.',

            'password.min'         => 'Password minimal 6 karakter.',
            'password.max'         => 'Password maksimal 16 karakter.',

            'newPassword.min'       => 'Password baru minimal 6 karakter.',
            'newPassword.max'       => 'Password baru maksimal 16 karakter.',
            'newPassword.different' => 'Password baru harus berbeda dari password lama.',
        ];
    }

    public function saveProfile()
    {
        $userID = Auth::user()->id;
        $user = User::find($userID);
        $validated = $this->validate(); // otomatis pakai rules() dan messages()

        // update user
        if ($this->password) {

            if (!Hash::check($this->password, $user->password)) {
                $this->addError('password', 'password yang anda masukan salah');
                return;
            }

            $user->update([
                'username' => $this->username,
                'email' => $this->email,
                'password' => $this->newPassword
            ]);
        } else {
            $user->update([
                'username' => $this->username,
                'email' => $this->email,
            ]);
        }

        // update profile
        $profile = ProfileModel::updateOrCreate(
            [
                'user_id' => $userID,
            ],
            [
                'user_id' => $userID,
                'fullname' => $this->fullname,
                'phone' => $this->phone,
                'adress' => $this->adress,
            ]
        );

        // jika ada img yg di upload
        if ($this->img_profile) {
            // dd($this->img_profile != );
            if (!empty($this->user->profile->img_profile)) {
                if ($this->img_profile != $this->user->profile->img_profile) {
                    // hapus file gambar lama
                    if (Storage::disk('public')->exists($this->user->profile->img_profile)) {
                        // maka delete
                        Storage::disk('public')->delete($this->user->profile->img_profile);
                    }
                }
            }
            $path = $this->img_profile->store('profiles', 'public'); //kirim ke Storage
            $user->profile->update([
                'img_profile' => $path
            ]);
            $this->reset('img_profile');
            $this->user->profile->refresh();
        }


        if ($user && $profile) {
            // untuk update img profile
            $this->dispatch('profile-updated', $path); //akan dikirim dan diterima oleh navmenu

            $this->dispatch('notify', status: 'success', message: 'Update profile berhasil');
            $this->reset('password', 'newPassword');
        } else {
            $this->dispatch('notify', status: 'failed', message: 'Gagal update profile berhasil');
        }
    }

    public function render()
    {
        return view('livewire.account.profile');
    }
}
