<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Product;

class CartService
{
    public function addToCart($produk_id)
    {
        $product = Product::find($produk_id);

        if (!$product) {
            return view('livewire.404');
        }

        // ini harus di handle dulu ketika belu login
        $cart = Cart::create([
            // 'user_id' => Auth::user()->id
            'user_id' => '1', // untuk testting,
            'product_id' => $produk_id,
            'qty' => '1', // quantity default nya 1 
            'price' => $product->price,
            'total_price' => $product->price,
        ]);

        if ($cart) {
            return [
                'status'=> true,
                'message' => 'produk telah masuk keranjang'
            ];
        } else {
            return [
                'status'=> false,
                'message' => 'produk gagal masuk keranjang'
            ];
        }
    }
}
