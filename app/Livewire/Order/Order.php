<?php

namespace App\Livewire\Order;

use App\Models\Order as OrderModel;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

#[\Livewire\Attributes\Layout('components.layouts.app')]
class Order extends Component
{
    public $orders, $user, $total_price, $codeOrder;

    public $snapToken = '';

    public function mount($codeOrder)
    {
        $this->user = Auth::user();
        // ambil semua order milik user yang login
        $this->orders = OrderModel::with('product')
            ->where('user_id', Auth::id())
            ->where(function ($q) use ($codeOrder) {
                $q->where('order_code', $codeOrder)
                    ->orWhere('order_code_group', $codeOrder);
            })
            ->get();

        $this->total_price = $this->orders->sum('total_price');


        // $user = Auth::user();

        // if (!$user->profile || empty($user->profile->fullname) && empty($user->profile->address)) {
        //     $this->dispatch('message_alert', status: 'failed', message: 'Nama lengkap/alamat belum diisi', title: 'Profile belum diisi');
        // }
        // $orders = OrderModel::with('product')->whereIn('id', $this->orders->pluck('id'))->get();

        // // $item_details = [];
        // // foreach ($orders as $order) {
        // //     $item_details[] = [
        // //         'id' => $order->id,
        // //         'title' => $order->product->title,
        // //         'price' => $order->product->price,
        // //         'quantity' => $order->qty,
        // //     ];
        // // }
        // // Set your Merchant Server Key
        // \Midtrans\Config::$serverKey = config('midtrans.midtrans_server_key');
        // // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        // \Midtrans\Config::$isProduction = config('midtrans.midtrans_isProduction');
        // // Set sanitization on (default)
        // \Midtrans\Config::$isSanitized = true;
        // // Set 3DS transaction for credit card to true
        // \Midtrans\Config::$is3ds = true;

        // $params = array(
        //     'transaction_details' => array(
        //         'order_id' => $orders->first()->order_code_group ?? $orders->first()->order_code,
        //         'gross_amount' => $this->total_price,
        //     ),
        //     'customer_details' => array(
        //         'username' => $user->username,
        //         'fullname' => $user->profile->fullname,
        //         'email' => $user->email,
        //         'phone' => $user->profile->phone,
        //     ),
        //     // 'item_details' => $item_details
        // );

        // $snapToken = \Midtrans\Snap::getSnapToken($params);
        // $this->snapToken = $snapToken;
    }


    public function render()
    {
        if ($this->orders->isEmpty()) {
            return view('livewire.404');
        }
        
        if ($this->orders->count() > 1) {
            $this->codeOrder = $this->orders->first()->order_code_group;
        } else {
            $this->codeOrder =  $this->orders->first()->order_code;
        }
        return view('livewire.order.order');
    }
}
