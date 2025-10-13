<?php

namespace App\Livewire\Cart;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart as CartModel;

class Cart extends Component
{
    public $quantities = [];
    public $total_price_all;

    // set default data increment 
    public function mount()
    {
        // $cartProducts = CartModel::where('user_id', Auth::user()->id());
        $cartProducts = CartModel::where('user_id', 1)->get(); // untuk test
        foreach ($cartProducts as $cart) {
            $this->quantities[$cart->id] = $cart->qty ?? 1;
        }
    }

    public function increment($cartId)
    {
        $productCart = CartModel::with('product')->find($cartId);
        // maksimal stock barang
        if ($this->quantities[$cartId] <= $productCart->product->stock - 1) {
            $this->quantities[$cartId]++;
            $this->updateCart($cartId);
        }
    }

    public function decrement($cartId)
    {
        if ($this->quantities[$cartId] > 1) {
            $this->quantities[$cartId]--;
            $this->updateCart($cartId);
        }
    }

    public function updateCart($cartId)
    {
        $cart = CartModel::find($cartId);
        $cart->qty =  $this->quantities[$cartId];
        $cart->total_price =  $cart->price * $this->quantities[$cartId];
        $cart->save();
    }

    public function delete($productId)
    {
        $cart = CartModel::find($productId);
        $cart->delete();
        // kirim notifikasi
        $this->dispatch('notify', status: 'success', message: 'product keranjang berhasil dihapus');
    }

    public function render()
    {
        // $productCarts = CartModel::where('user_id', Auth::user()->id());
        $productCarts = CartModel::with('product')->where('user_id', 1)->get(); // untuk testing aja dulu;

        $productCarts->transform(function ($cart) {
            $cart->product->thumbnail = !empty($cart->product->thumbnail)
                ?  asset('storage/' . $cart->product->thumbnail)
                : asset('assets/images/images404.png');
            return $cart;
        });

        // total semua barang
        $this->total_price_all = $productCarts->sum('total_price');

        return view('livewire.cart.cart', compact('productCarts'));
    }
}
