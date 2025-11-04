<?php

namespace App\Livewire\Dashboard;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Livewire\Component;

#[\Livewire\Attributes\Layout('components.layouts.dashboard')]
class Dashboard extends Component
{
    public $stock = 0;
    public $labels, $chartOrders;

    public function mount()
    {
        $dates = [];
        $orders = [];
        for ($i = 0; $i <= 6; $i++) {
            $date = Carbon::now()->subDays($i);
            $orders[] = Order::where('status', 'paid')
                ->where('date', $date->toDateString())
                ->count();
                $dates[] = date_format($date, 'Y M d');
            }
            $this->labels = array_reverse($dates);
            $this->chartOrders = array_reverse($orders);
    }

    // untuk edit
    protected $listeners = ['updateItem' => 'edit', 'deleteItem' => 'delete'];
    public function edit($id)
    {
        $productStock = Product::find($id);
        if (empty($productStock)) {
            return view('livewire.404');
        }

        $this->stock = $productStock->stock;
    }
    public function updateStock($id)
    {
        $this->validate(['stock' => 'required|integer|min:0']);
        $product = Product::find($id);
        if (empty($product)) {
            return view('livewire.404');
        }
        $product->stock = $this->stock;
        if ($product->save()) {
            $this->dispatch('notify', status: 'success', message: 'Stock berhasi diubah');
        } else {
            $this->dispatch('notify', status: 'failed', message: 'Stock gagal diubah');
        }
    }

    public function delete($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return view('livewire.404');
        }

        if ($product->delete()) {
            $this->dispatch('notify', status: 'success', message: 'Stock berhasi dihapus');
        } else {
            $this->dispatch('notify', status: 'failed', message: 'Stock gagal dihapus');
        }
    }

    public function render()
    {
        $totalProducts = Product::count();
        $totalUsers = User::count();
        $totalOrders = Order::count();

        $stockProducts = Product::where('status', 'publish')->orderBy('stock', 'asc')->limit(5)->get();
        $orders = Order::with('product')
            ->latest()
            ->limit(5)
            ->get()
            ->groupBy(function ($order) {
                return $order->order_code_group ?? $order->order_code;
            });

        return view('livewire.dashboard.index', compact('totalProducts', 'totalUsers', 'totalOrders', 'stockProducts', 'orders'));
    }
}
