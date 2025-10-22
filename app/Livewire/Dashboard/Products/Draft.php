<?php

namespace App\Livewire\Dashboard\Products;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\WithFileUploads;

#[\Livewire\Attributes\Layout('components.layouts.dashboard')]
#[\Livewire\Attributes\Title('Dashboard Products Draft')]
class Draft extends Component
{
    use WithPagination, WithoutUrlPagination, WithFileUploads;

    public $search = '',
        $categorySelected = '';

    public $selectBtnCond = false,
        $selectAll = false,
        $selectedId = [];

    public $title = '',
        $slug  = '',
        $category = '',
        $price = '',
        $stock = '',
        $status = '',
        $desc = '',
        $thumbnail = '',
        $images = [];

    public $productsSelect;
    // untuk muncul select
    public function selectBtn()
    {
        $this->selectBtnCond = !$this->selectBtnCond;
    }
    // rules
    // untuk validatsi 
    public function rules()
    {
        $rules = [
            'title' => 'required|string|max:255',
            'category' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'status' => 'required|in:publish,draft',
            'desc' => 'nullable|string|max:1000',
            'thumbnail' => 'nullable|max:2048', // 2MB
            'images.*' => 'nullable|max:2048', // untuk multi upload
        ];
        return $rules;
    }
    public function messages()
    {
        return [
            'title.required' => 'Judul produk wajib diisi.',

            'slug.required' => 'Slug wajib diisi.',
            'slug.unique' => 'Slug sudah digunakan, silakan pilih yang lain.',

            'category.required' => 'Kategori wajib dipilih.',
            'category.exists' => 'Kategori tidak valid.',

            'price.required' => 'Harga wajib diisi.',
            'price.numeric' => 'Harga harus berupa angka.',

            'stock.required' => 'Stok wajib diisi.',
            'stock.integer' => 'Stok harus berupa angka bulat.',

            'status.required' => 'Status wajib dipilih.',
            'status.in' => 'Status harus antara publish atau draft.',

            'desc.max' => 'Deskripsi maksimal 1000 karakter.',

            'thumbnail.image' => 'Thumbnail harus berupa gambar.',
            'thumbnail.max' => 'Ukuran thumbnail maksimal 2MB.',

            'images.*.image' => 'Setiap file harus berupa gambar.',
            'images.*.max' => 'Ukuran setiap gambar maksimal 2MB.',
        ];
    }


    // update product
    public function updateProduct($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return view('livewire.404');
        }

        $rules = $this->rules(); // diambil dari method ruels

        // jika slug berbda
        if ($this->slug != $product->slug) {
            $slug = $this->slug;
            $rules['slug'] = 'required|string|max:255|unique:products,slug';
        } else {
            $slug = $product->slug; // gunaka slug lama
        }
        $validated = $this->validate($rules);


        // cek file lama
        if (!empty($this->thumbnail) && $this->thumbnail != $product->thumbnail) {
            if (!empty($product->thumbnail)) {
                if (Storage::disk('public')->exists($product->thumbnail)) {
                    Storage::disk('public')->delete($product->thumbnail);
                }
            }
            $pathThumbnail = $this->thumbnail->store('products', 'public');
        } else {
            $pathThumbnail = $product->thumbnail; // gunakan data yg lama
        }

        if (!empty($this->images) &&  $this->images != json_decode($product->images, true)) {
            $images = [];
            foreach ($this->images as $image) {
                // hapus file lama
                if (!empty($product->images)) {
                    if (Storage::disk('public')->exists($image)) {
                        Storage::disk('public')->delete($image);
                    }
                }
                $images[] = $image->store('products', 'public');
                $pathImages = json_encode($images);
            }
        } else {
            $pathImages = $product->images; // gunakan data lama
        }


        $product->title = $this->title;
        $product->slug = $slug;
        $product->category_id = $this->category;
        $product->stock = $this->stock;
        $product->status = $this->status;
        $product->desc = $this->desc;
        $product->thumbnail = $pathThumbnail;
        $product->images = $pathImages;

        // jika berhasil di save
        if ($product->save()) {
            $this->dispatch('notify', status: 'success', message: 'produk berhasil diupdate');
        } else {
            $this->dispatch('notify', status: 'failed', message: 'produk gagal diupdate');
        }
    }

    // update slug
    public function updatedTitle($value)
    {
        $slug = Str::slug($value);
        $count = Product::where('slug', 'like', '%' . $value . '%')->count();
        if ($count > 0) {
            $slug .= '-' . ($count + 1);
        }
        $this->slug = $slug;
    }

    // select all delete
    // ketika slect all
    public function updatedSelectAll($value)
    {
        if ($value) {
            // jika hasi nya true maka
            $this->selectedId = $this->productsSelect->pluck('id')->toArray();
        } else {
            $this->selectedId = [];
        }
    }

    public function updatedSelectedId()
    {
        $this->selectAll = count($this->selectedId) === $this->productsSelect->count();
    }

    public function deleteItem()
    {
        if (empty($this->selectedId)) {
            return $this->dispatch('notify', status: 'failed', message: 'data gagal dihapus');
        }

        $products = Product::whereIn('id', $this->selectedId)->get();

        foreach ($products as $product) {
            // hapus img
            if (!empty($product->thumbnail)) {
                if (Storage::disk('public')->exists($product->thumbnail)) {
                    Storage::disk('public')->delete($product->thumbnail);
                }
            }
            if (!empty($product->images)) {
                foreach (json_decode($product->images, true) as $image) {
                    if (Storage::disk('public')->exists($image)) {
                        Storage::disk('public')->delete($image);
                    }
                }
            }
            // hapus product
            $product->delete();
        }

        // reset selected
        $this->selectedId = [];
        $this->selectAll = false;
        $this->productsSelect = Product::where('status', 'draft')->get();
        $this->resetPage();
        $this->dispatch('$refresh');

        $this->dispatch('notify', status: 'success', message: 'data berhasil dihapus');
    }
    protected $listeners = ['deleteItem' => 'delete', 'updateItem' => 'edit'];
    public function delete($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return view('livewire.404');
        }

        // hapus img
        if (!empty($product->thumbnail)) {
            if (Storage::disk('public')->exists($product->thumbnail)) {
                Storage::disk('public')->delete($product->thumbnail);
            }
        }
        // dd($product->images == null);
        if (!empty($product->images)) {
            foreach (json_decode($product->images, true) as $image) {
                if (Storage::disk('public')->exists($image)) {
                    Storage::disk('public')->delete($image);
                }
            }
        }

        if ($product->delete()) {
            $this->dispatch('notify', status: 'success', message: 'data produk berhasil dihapus');
        } else {
            $this->dispatch('notify', status: 'failed', message: 'data produk gagal dihapus');
        }
    }
    // update data berdasarkan id
    public function edit($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return view('livewire.404');
        }

        $this->title = $product->title;
        $this->slug  = $product->slug;
        $this->category = $product->category->id;
        $this->price = $product->price;
        $this->stock = $product->stock;
        $this->status = $product->status;
        $this->desc = $product->desc;
        $this->thumbnail = $product->thumbnail;
        $this->images = json_decode($product->images, true);
    }

    public function render()
    {
        $products = Product::with('category')
            ->where('status', 'draft')
            ->latest()
            ->when($this->search || $this->categorySelected, function ($q) {
                $q->where(function ($query) {
                    // Jika ada pencarian
                    if ($this->search) {
                        $query->where(function ($sub) {
                            $sub->where('title', 'like', '%' . $this->search . '%')
                                // ->where('created_at')
                                ->orWhere('desc', 'like', '%' . $this->search . '%')
                                ->orWhereHas('category', function ($cat) {
                                    $cat->where('title', 'like', '%' . $this->search . '%');
                                });
                        });
                    }

                    // Jika hanya kategori dipilih
                    if ($this->categorySelected) {
                        $query->whereHas('category', function ($cat) {
                            $cat->where('title', 'like', '%' . $this->categorySelected . '%');
                        });
                    }

                });
            })
            ->paginate(10);
        $categories = Category::latest()->get();
        $this->productsSelect = Product::where('status', 'draft')->get();
        return view('livewire.dashboard.products.draft', compact('products', 'categories'));
    }
}
