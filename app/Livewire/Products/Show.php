<?php

namespace App\Livewire\Products;

use App\Models\Order;
use App\Models\Product;
use Livewire\Component;
use App\Services\CartService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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
        $this->images = json_decode($this->product->images ?? null, true);

        $this->thumbnail = !empty($this->product->thumbnail)
            ? asset("storage/" . $this->product->thumbnail)
            : asset('assets/images/images404.png');
    }

    // check out
    public function checkOut($productId)
    {
         $product = Product::find($productId);

         $order = Order::create([
            'user_id' => Auth::user()->id,
            'product_id' => $product->id,
            'qty' => 1, // untuk sementar 1 
            'price' => $product->price,
            'status' => 'pending',
            'total_price' => $product->price,
            'order_code'=> makeOrderCode(),
            'date' => Carbon::today()->toDateString()
         ]);

         return $this->redirectRoute('order', ['codeOrder' => $order->order_code], navigate:true);
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
            ->where('status', 'publish')
            ->get();

        return view('livewire.products.show', compact('products'))
            ->title($this->product->title);
    }
}
