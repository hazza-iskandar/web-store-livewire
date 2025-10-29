<?php

namespace App\Livewire\Dashboard\Hightlight;

use App\Models\Banner;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\WithoutUrlPagination;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

#[\Livewire\Attributes\Layout('components.layouts.dashboard')]
#[\Livewire\Attributes\Title('Hightlight Product')]
class Index extends Component
{
    use WithPagination, WithoutUrlPagination, WithFileUploads;

    public $title = '',
        $type = '',
        $is_active = false,
        $btn_detail = false,
        $img_banner,
        $desc = '';

    public $search = '',
        $filterType = '',
        $filterStatus = '';

    public $chooseProduct;
    public $btnDetailCond = false;

    public $bannerId;

    public $bannerSelected,
        $selectBtnCond = false,
        $selectAll = false,
        $selectedId = [];


    public function updatedChooseProduct($id)
    {
        if ($id == 'reset') {
            $this->reset('title', 'desc', 'img_banner', 'chooseProduct');
            $this->btnDetailCond = false;
        }

        $product = Product::find($id);
        if (!$product) {
            return view('livewire.404');
        }

        if ($id) {
            $this->title = $product->title;
            $this->desc = $product->desc;
            $this->img_banner = $product->thumbnail;
            $this->btnDetailCond = true;
        }
    }

    // untuk muncul select
    public function selectBtn()
    {
        $this->selectBtnCond = !$this->selectBtnCond;
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedId = $this->bannerSelected->pluck('id')->toArray();
        } else {
            $this->selectedId = [];
        }
    }

    public function updatedSelectedId()
    {
        $this->selectAll = count($this->selectedId) == $this->bannerSelected->count();
    }

    public function deleteItems()
    {
        if (empty($this->selectedId)) {
            return $this->dispatch('notify', status: 'failed', message: 'data gagal dihapus');
        }

        $banners = Banner::whereIn('id', $this->selectedId)->get();
        foreach ($banners as $banner) {
            if (!empty($banner->img_banner)) {
                if (Storage::disk('public')->exists($banner->img_banner)) {
                    Storage::disk('public')->delete($banner->img_banner);
                }
            }

            $banner->delete();
        }

        // reset selected
        $this->selectedId = [];
        $this->selectAll = false;
        $this->bannerSelected = Banner::all();
        $this->resetPage();
        $this->dispatch('$refresh');

        $this->dispatch('notify', status: 'success', message: 'banner hightlight berhasil dihapus');
    }

    // jika ada delete
    protected $listeners = ['deleteItem' => 'delete', 'updateItem' => 'edit'];
    public function delete($id)
    {
        $banner = Banner::find($id);
        if (!$banner) {
            return view('livewire.404');
        }

        if (!empty($banner->img_banner) && Storage::disk('public')->exists($banner->img_banner)) {
            Storage::disk('public')->delete($banner->img_banner);
        }

        if ($banner->delete()) {
            $this->dispatch('notify', status: 'success', message: 'banner hightlight berhasil dihapus');
        } else {
            $this->dispatch('notify', status: 'failed', message: 'banner hightlight gagal dihapus');
        }
    }

    public function edit($id)
    {
        $banner = Banner::find($id);

        if (!$banner) {
            return view('livewire.404');
        }


        if ($banner) {
            $this->title = $banner->title;
            $this->type = $banner->type;
            $this->is_active = $banner->is_active;
            $this->btn_detail = $banner->btn_detail;
            $this->img_banner = $banner->img_banner;
            $this->desc = $banner->desc;
            $this->bannerId = $banner->id;
        }
    }

    // create or udpate banner
    public function storeBanner()
    {
        // jika ada img diupload maka rules nya kasi
        $rules = $this->rules();
        // untuk cek apakah ada file upload
        if ($this->img_banner instanceof TemporaryUploadedFile) {
            $rules['img_banner'] = 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048';
            // happus img lama
            $banner = Banner::find($this->bannerId);
            if (!empty($banner->img_banner) && Storage::disk('public')->exists($banner->img_banner)) {
                Storage::disk('public')->delete($banner->img_banner);
            }
            $path = $this->img_banner->store('banners', 'public');
        } else {
            $path = $this->img_banner;
        }

        // kirim ke data kerules
        $this->validate($rules);

        $banner = Banner::updateOrCreate(
            [
                'id' => $this->bannerId
            ],
            [
                'product_id' => $this->chooseProduct ?? NULL,
                'title' => $this->title,
                'desc' => $this->desc,
                'img_banner' => $path ?? NULL,
                'type' =>  $this->type,
                'is_active' => $this->is_active,
                'btn_detail' => $this->btn_detail,
            ]
        );

        if ($banner) {
            $this->dispatch('notify', status: 'success', message: 'banner hightlight berhasil disimpan');
            $this->reset('title', 'desc', 'type', 'img_banner', 'btn_detail', 'is_active', 'chooseProduct');
        } else {
            $this->dispatch('notify', status: 'failed', message: 'banner hightlight gagal simpan');
        }
    }

    // rules & message validate
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'desc' => 'required|string|max:1080',
            'type' => 'required|in:slider,highlight',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Judul wajib diisi.',
            'title.string' => 'Judul harus berupa teks.',
            'title.max' => 'Judul maksimal 255 karakter.',

            'desc.required' => 'Deskripsi wajib diisi.',
            'desc.string' => 'Deskripsi harus berupa teks.',
            'desc.max' => 'Deskripsi maksimal 1080 karakter.',

            'img_banner.image' => 'File banner harus berupa gambar.',
            'img_banner.mimes' => 'Format gambar harus jpeg, png, jpg, atau webp.',
            'img_banner.max' => 'Ukuran gambar maksimal 2MB.',

            'type.required' => 'Tipe wajib diisi.',
            'type.in' => 'Tipe banner hanya boleh bernilai slider atau highlight.',
        ];
    }
    public function resetForm()
    {
        $this->reset('title', 'desc', 'type', 'img_banner', 'btn_detail', 'is_active','chooseProduct');
    }

    public function render()
    {
        $banners = Banner::with('product', 'category')
            ->when($this->search, function($q){
                $q->whereAny(['title'], 'like', "%{$this->search}%");
            })
            ->when($this->filterType, function($q){
                $q->where('type', $this->filterType);
            })
            ->when($this->filterStatus, function($q){
                $q->where('is_active', $this->filterStatus);
            })
            ->latest()
            ->paginate(5);

        // products
        $products = Product::with('category')
            ->latest()
            ->get();

        $this->bannerSelected = Banner::all();

        return view('livewire.dashboard.hightlight.index', compact('banners', 'products'));
    }
}
