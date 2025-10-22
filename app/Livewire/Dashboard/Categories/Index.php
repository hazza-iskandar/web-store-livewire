<?php

namespace App\Livewire\Dashboard\Categories;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

#[\Livewire\Attributes\Layout('components.layouts.dashboard')]
#[\Livewire\Attributes\Title('Dashboard Categories')]
class Index extends Component
{
    use WithPagination, WithoutUrlPagination;
    
    public $search = '',
        $selectBtnCond = false,
        $selectAll = false,
        $selectedId = [];
    public $categoriesSelected;
    public $title = '', $desc = '';


    public function mount()
    {
        $this->categoriesSelected = Category::all();
    }

    // untuk muncul select
    public function selectBtn()
    {
        $this->selectBtnCond = !$this->selectBtnCond;
    }

    // validate store
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'desc' => 'nullable|string|max:1000'
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Judul kategori wajib diisi',
            'title.string' => 'Judul harus beruba huruf',
            'title.max' => 'Judul kata sudah maksimal',

            'desc.string' => 'Deskripsi harus beruba huruf',
            'desc.max' => 'Deskripsi kata sudah maksimal',
        ];
    }
    public function createReset()
    {
        $this->reset('title', 'desc');
    }
    public function storeCategory()
    {
        $this->validate();

        $category = Category::create([
            'title' => $this->title,
            'desc' => $this->desc,
        ]);

        if ($category) {
            $this->reset('title', 'desc');
            $this->dispatch('notify', status: 'success', message: 'tambah kategori berhasil');
        } else {
            $this->dispatch('notify', status: 'failed', message: 'tambah kategori gagal');
        }
    }

    // hapus Item
    protected $listeners = ['deleteItem' => 'delete', 'updateItem' => 'edit'];
    public function delete($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return view('livewire.404');
        }

        if ($category->delete()) {
            $this->dispatch('notify', status: 'success', message: 'kategori berhasil dihapus');
        } else {
            $this->dispatch('notify', status: 'failed', message: 'kategori gagal dihapus');
        }
    }
    // delete all selected
    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedId = $this->categoriesSelected->pluck('id')->toArray();
        } else {
            $this->selectedId = [];
        }
    }
    public function updatedSelectedId()
    {
        $this->selectAll = count($this->selectedId) === $this->categoriesSelected->count();
    }
    public function deleteItem()
    {
        $categories = Category::whereIn('id', $this->selectedId)->get();
        foreach ($categories as $category) {
            $category->delete();
        }
        $this->selectedId = [];
        $this->selectAll = false;
        $this->dispatch('notify', status: 'success', message: 'data berhasil dihapus');
    }

    // update item
    public function edit($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return view('livewire.404');
        }
        $this->title = $category->title;
        $this->desc = $category->desc;
    }

    public function updateCategory($id)
    {
        $this->validate();

        $category = Category::find($id);
        if (!$category) {
            return view('livewire.404');
        }

        $category->title = $this->title;
        $category->desc = $this->desc;
        if ($category->save()) {
            $this->dispatch('notify', status: 'success', message: 'category berhasil diupdate');
        } else {
            $this->dispatch('notify', status: 'failed', message: 'category gagal diupdate');
        }
    }

    public function render()
    {
        $categories = Category::when($this->search, function ($category) {
            $category->whereAny(['title'], 'like', "%{$this->search}%");
        })
            ->latest()
            ->paginate(10);
        return view('livewire.dashboard.categories.index', compact('categories'));
    }
}
