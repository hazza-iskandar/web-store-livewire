<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class NavMenu extends Component
{
    public $search, $img_profile;

    public function mount()
    {
        // akan mengambil data
        $this->img_profile = Auth::user()->profile->img_profile ?? null;
    }

    #[On('profile-updated')]
    public function updateProfileImage($newUrl)
    {
        // Ambil path baru dari event yg dikirim dari update profile
        $this->img_profile = $newUrl; // ubah sementar ketiak navigatter/refresh maka akan ambil dir database
    }

    public function resetSearch()
    {
        $this->search = '';
    }

    // logout
    public function logout()
    {
        Auth::logout();

        $this->redirectRoute('home', navigate: true);
    }

    public function render()
    {
        $products = Product::with('category')
            ->when(strlen(trim($this->search)) > 0, function ($query) {
                $query->whereAny(['title'], 'like', '%' . $this->search . '%')
                    ->orWhereHas('category', function ($q) {
                        $q->whereAny(['title'], 'like', '%' . $this->search . '%');
                    });
            })
            ->get();

        return view('livewire.nav-menu', compact('products'));
    }
}
