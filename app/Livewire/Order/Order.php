<?php

namespace App\Livewire\Order;

use App\Models\Order as OrderModel;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

#[\Livewire\Attributes\Layout('components.layouts.app')]
class Order extends Component
{
    public $orders, $user, $total_price, $codeOrder;

    public function mount($codeOrder)
    {
        $this->user = Auth::user();
        // ambil semua order milik user yang login
        $this->orders = OrderModel::with('product')
            ->where('user_id', Auth::id())
            ->where('order_code', $codeOrder)
            ->orWhere('order_code_group', $codeOrder)
            ->get();
    }


    public function render()
    {
        $this->total_price = $this->orders->sum('total_price');

        if($this->orders->count() > 1){
            $this->codeOrder = $this->orders->first()->order_code_group;
        }else{
            $this->codeOrder =  $this->orders->first()->order_code;
        }
        return view('livewire.order.order');
    }
}
