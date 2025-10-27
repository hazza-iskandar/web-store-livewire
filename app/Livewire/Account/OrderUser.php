<?php

namespace App\Livewire\Account;

use App\Models\Order;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

#[\Livewire\Attributes\Title('Pesanan User')]
class OrderUser extends Component
{
    use WithPagination, WithoutUrlPagination;

    public  $status = 'pending';
    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function deleteOrder($code)
    {
        Order::where('order_code_group', $code)
            ->orWhere('order_code', $code)
            ->delete();
        $this->dispatch('notify', status: 'success', message: 'order berhasil dihapus');
    }

    public function canceledOrder($code)
    {
        Order::where('order_code_group', $code)
            ->orWhere('order_code', $code)
            ->update([
                'status' => 'canceled'
            ]);
        $this->dispatch('notify', status: 'success', message: 'order telah dibatalkan');
    }

    public function render()
    {
        $userId = Auth::id();
        $orders = Order::with('product.category')
            ->where('user_id', $userId)
            ->where('status', $this->status)
            ->get()
            ->groupBy(function ($order) {
                return $order->order_code_group ?? $order->order_code;
            });


        // dd($orders);
        return view('livewire.account.order-user', compact('orders'));
    }
}
