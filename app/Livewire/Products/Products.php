<?php

namespace App\Livewire\Products;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Services\CartService;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Livewire\Features\SupportPagination\WithoutUrlPagination;

#[\Livewire\Attributes\Title('Products')]
#[\Livewire\Attributes\Layout('components.layouts.app')]
class Products extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $thumbnail, $category;
    public $search = '';
    public $categorySelected;

    public function mount()
    {
        $this->categorySelected = request('category');
    }
    // untuk jalankan service nya
    protected $cartService;
    public function boot(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function addToCart($produk_id)
    {
        // ambil fungsi serveice
        $result = $this->cartService->addToCart($produk_id);

        // nanti data result akan di kirim ke frontend
        $this->dispatch('notify', status: $result['status'] ? 'success' : 'failed',  message: $result['message']);
    }

    public function searcCategory($slug)
    {
        $this->categorySelected = $slug;
    }

    public function resetCategory()
    {
        unset($this->categorySelected); // clear category yg di set
    }

    public function render()
    {
        $products = Product::with('category')
            ->when($this->search, function ($q) {
                $q->whereAny(['title', 'desc'], 'like', '%' . $this->search . '%');
            })
            ->when(isset($this->categorySelected), function ($product) { // ketika ada isset kategory maka cari data dari relasi category
                $product->whereHas('category', function ($q) {
                    $q->where('slug', $this->categorySelected);
                });
            })
            ->paginate(8);

        $categories = Category::get();


        return view('livewire.products.products', compact('products', 'categories'));
    }
}
