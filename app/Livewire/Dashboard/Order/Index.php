<?php

namespace App\Livewire\Dashboard\Order;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

#[\Livewire\Attributes\Layout('components.layouts.dashboard')]
#[\Livewire\Attributes\Title('Management Orders')]

class Index extends Component
{
    use WithPagination;

    public $search = '';

    public $totalPrice;

    public $selectBtnCond = false,
        $selectAll = false,
        $selectedCode = [];
    public $orderSelected;

    public $perPage = 10;

    // untuk muncul select
    public function selectBtn()
    {
        $this->selectBtnCond = !$this->selectBtnCond;
    }
    // ketika slect all
    public function updatedSelectAll($value)
    {
        if ($value) {
            // jika hasi nya true maka
            $this->selectedCode = $this->orderSelected->toArray();
        } else {
            $this->selectedCode = [];
        }
    }

    public function updatedSelectedCode()
    {
        $this->selectAll = count($this->selectedCode) === $this->orderSelected->count();
    }

    public function deleteItem()
    {
        if (empty($this->selectedCode)) {
            return $this->dispatch('notify', status: 'failed', message: 'data gagal dihapus');
        }

        $order = Order::whereIn('order_code_group', $this->selectedCode)
            ->orWhereIn('order_code', $this->selectedCode)
            ->delete();

        // reset selected
        $this->selectedCode = [];
        $this->selectAll = false;

        $this->dispatch('notify', status: 'success', message: 'data berhasil dihapus');
    }

    public function loadMore()
    {
        $this->perPage += 10;
    }


    public function render()
    {
        // ambil paginator
        $paginator = Order::with('product')
            ->when($this->search, function ($q) {
                $q->whereAny(['order_code_group', 'order_code'], 'like', "%{$this->search}%");
            })
            ->latest()
            ->paginate($this->perPage);

        // ambil item-nya lalu group
        $orders = $paginator->getCollection()
            ->groupBy(function ($order) {
                return $order->order_code_group ?? $order->order_code;
            });

        // set ulang hasil group ke paginator
        $paginator->setCollection($orders->flatten());

        // kalau kamu butuh group-nya untuk tampil berbeda
        $this->orderSelected = $orders->keys();

        return view('livewire.dashboard.order.index', [
            'orders' => $orders,
            'paginator' => $paginator
        ]);
    }
}
