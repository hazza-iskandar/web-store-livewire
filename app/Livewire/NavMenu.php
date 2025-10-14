<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class NavMenu extends Component
{
    public $search;

    public function resetSearch()
    {
        $this->search = '';
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
