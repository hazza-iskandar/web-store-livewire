<?php

namespace App\Livewire\Products;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Features\SupportPagination\WithoutUrlPagination;

#[\Livewire\Attributes\Title('Products')]
#[\Livewire\Attributes\Layout('components.layouts.app')]
class Products extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $thumbnail, $category;
    public $search = '';

    public function render()
    {
        $products = Product::with('category')
        ->when($this->search, function($q){
            $q->whereAny(['title', 'desc'], 'like', '%'. $this->search .'%');
        })->paginate(8);

        // if ($this->search) {
        //     $products = $products->where('title', $this->search)->get();
        //     // $products->whereAny(['title', 'desc'], 'like', '%' . $this->search . '%');
        // }else{
        //     $products = $products->get();
        // }

        // mapping/transform isi thumbnail
        $products->transform(function ($product) {
            $product->thumbnail = !empty($product->thumbnail)
                ? asset("storage/" . $product->thumbnail)
                : asset('assets/images/images404.png');
            return $product;
        });

        $categories = Category::get();

        return view('livewire.products.products', compact('products', 'categories'));
    }
}
