<?php

namespace App\Livewire\Cart;

use Carbon\Carbon;
use App\Models\Product;
use Livewire\Component;
use App\Models\Cart as CartModel;
use App\Models\Order as OrderModel;
use Illuminate\Support\Facades\Auth;

#[\Livewire\Attributes\Title('Carts')]
class Cart extends Component
{
    public $quantities = [];
    public $total_price_all;

    public $selectAll = false;
    public $selectedId = [];

    public $productCarts;
    public $order;
    // set default data increment 
    public function mount()
    {
        $cartProducts = CartModel::where('user_id', Auth::user()->id)->get();
        // $cartProducts = CartModel::where('user_id', 1)->get(); // untuk test
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

    public function updatedSelectAll($value)
    {
        if ($value) {
            // ambil id dari cart, bukan product
            $this->selectedId = $this->productCarts->pluck('id')->toArray();
        } else {
            $this->selectedId = [];
        }
    }

    public function updatedSelectedId()
    {
        // jika semua id terpilih, selectAll = true
        $this->selectAll = count($this->selectedId) === $this->productCarts->count();
    }

    public function checkOut($productIds)
    {
        $carts = CartModel::whereIn('id', $productIds)->get();
        $codeOrderGroup = makeGroupOrderCode();

        $result = [];
        foreach ($carts as $cart) {
            $order = OrderModel::create([
                'user_id' => Auth::user()->id,
                'product_id' => $cart->product->id,
                'cart_id' => $cart->id,
                'qty' => $cart->qty, // untuk sementar 1 
                'price' => $cart->product->price,
                'status' => 'pending',
                'total_price' => $cart->total_price,
                'order_code' => makeOrderCode(),
                'order_code_group' => $codeOrderGroup,
                'date' => Carbon::today()->toDateString()
            ]);
            $result[] = $order;
        }
        if(!empty($result)){
            return $this->redirectRoute('order', ['codeOrder' => $result[0]->order_code_group], navigate: true);
        }else{
            return $this->dispatch('notify', status:'failed', message:'belum tambah barang');
        }
    }

    public function render()
    {
        $productCarts = CartModel::where('user_id', Auth::user()->id)->get();

        // total semua barang
        // Kalau tidak ada yang dipilih → total 0
        // Ambil hanya cart yang terpilih
        $this->total_price_all = $productCarts
            ->whereIn('id', $this->selectedId)
            ->sum('total_price');


        $this->productCarts = $productCarts;
        return view('livewire.cart.cart');
    }
}
