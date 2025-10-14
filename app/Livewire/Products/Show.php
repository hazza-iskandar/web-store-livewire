<?php

namespace App\Livewire\Products;

use App\Models\Product;
use App\Services\CartService;
use Livewire\Component;

#[\Livewire\Attributes\Layout('components.layouts.app')]
class Show extends Component
{
    public $slug, $product, $images, $thumbnail;
    public $search = '';

    // fitur keranjang di ambil dari service
    protected $cartService;
    public function boot(CartService $cartService)
    {
        $this->cartService = $cartService;
    }
    public function addToCart($productId)
    {
        $result = $this->cartService->addToCart($productId);
        $this->dispatch('notify', status: $result['status'] ? 'success' : 'failed', message: $result['message']);
    }

    public function mount(String $slug)
    {
        $this->slug = $slug;
        $this->product = Product::with('category')->where('slug', $slug)->first();
        $this->images = json_decode($this->product->images, true) ?? null;

        $this->thumbnail = !empty($this->product->thumbnail)
            ? asset("storage/" . $this->product->thumbnail)
            : asset('assets/images/images404.png');
    }

    public function render()
    {
        if (!$this->product) {
            return view('livewire.404');
        }

        $products = Product::with(['category'])
            ->where('category_id', $this->product->category_id)
            ->where('id', '!=', $this->product->id)
            ->limit(8)
            ->get();

        return view('livewire.products.show', compact('products'))
            ->title($this->product->title);
    }
}
