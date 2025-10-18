<?php

namespace App\Livewire;

use App\Models\Banner;
use Carbon\Carbon;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Services\CartService;

#[\Livewire\Attributes\Layout('components.layouts.app')]
class Home extends Component
{
    // untuk fitur keranjang
    protected $cartService;
    public function boot(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function addToCart($productId)
    {
        $result = $this->cartService->addToCart($productId);

        if ($result['status'] === 'eror 404') {
            return view('livewire.404');
        } else if ($result['status'] === 'eror 401') {
            return $this->redirectRoute('login', navigate: true);
        }

        $this->dispatch('notify', status: $result['status'] ? 'success' : 'failed', message: $result['message']);
    }

    public function render()
    {
        $nextDays = Carbon::today()->addDays(5);
        $newProducts = Product::with('category:id,title')
            ->whereBetween('created_at', [today(), $nextDays])
            ->where('status', 'publish')
            ->get();
        $categories = Category::all();

        $allProduct1 = Product::with('category:id,title')
            ->limit(5)
            ->where('status', 'publish')
            ->get();
        $allProduct2 = Product::with('category:id,title')
            ->skip(5)
            ->limit(5)
            ->where('status', 'publish')
            ->get();

        $sliders = Banner::with('product', 'category:id,title')
            ->where('type', 'slider')
            ->get();
        $hightlight = Banner::with('product', 'category:id,title')
            ->where('type', 'highlight')
            ->first();

        return view('livewire.index', compact(
            'newProducts',
            'categories',
            'allProduct1',
            'allProduct2',
            'sliders',
            'hightlight'
        ));
    }
}
