<?php

namespace App\Livewire\Order;

use Livewire\Component;
use App\Models\Order as OrderModel;

class OrderSuccess extends Component
{
    public $orders;
    public function mount($code)
    {
        $this->orders = OrderModel::where('order_code_group', $code)
            ->orWhere('order_code', $code)->get();
    }
    public function render()
    {
        if($this->orders->isEmpty()){
            return view('livewire.404');
        }
        $orderCode = $this->orders->first();
        $totalHarga = $this->orders->sum('total_price');
        return view('livewire.order.order-success', compact('orderCode', 'totalHarga'));
    }
}
