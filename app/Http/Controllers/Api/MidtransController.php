<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class MidtransController extends Controller
{
    public function callback(Request $request)
    {
        $serverKey = config('midtrans.midtrans_server_key');
        $hashed = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                $orders = Order::where('order_code_group', $request->order_id)
                    ->orWhere('order_code', $request->order_id)
                    ->get();
                foreach ($orders as $order) {
                    $order->status = 'paid';
                    if ($order->product) {
                        $order->product->stock -= $order->qty;
                        $order->product->total_sold += $order->qty;
                        $order->product->save();
                    }
                    $order->save();
                }
            }
        }
        
        return response()->json([
            'message' => 'sudah terbayar',
            'order_code' => $request->order_id
        ]);
    }
}
