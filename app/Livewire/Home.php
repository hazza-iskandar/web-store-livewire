<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use App\Services\CartService;
use Carbon\Carbon;
use Livewire\Component;

#[\Livewire\Attributes\Layout('components.layouts.app')]
#[\Livewire\Attributes\Title('Zaa Store')]
class Home extends Component
{
    protected $cartService;
    public function boot(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function addToCart($productId)
    {
        $result = $this->cartService->addToCart($productId);

        $this->dispatch('notify', status:$result['status'] ? 'success' : 'failed', message:$result['message']);
    }

    public function render()
    {
        $nextDays = Carbon::today()->addDays(5);
        $newProducts = Product::whereBetween('created_at', [today(), $nextDays])->get();
        $categories = Category::all();

        $allProduct1 = Product::limit(5)->get();
        $allProduct2 = Product::skip(5)->limit(5)->get();
        return view('livewire.index', compact('newProducts', 'categories', 'allProduct1', 'allProduct2'));
    }
}
