<?php

namespace App\Livewire\SuperDuper\Pages;

use App\Models\Product;
use App\Models\ProductCategory;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;

    public $search = '';

    public $sortBy = 'position';

    public $productCategory = null;

    public $tag = null;

    public $discount = null;

    public $perPage = 12;

    public $priceMin;

    public $priceMax;

    public $minPrice;

    public $maxPrice;

    public $modalProduct;

    public array $selectedTags = [];

    protected $queryString = [
        'search', 'sortBy', 'productCategory', 'tag', 'discount',
        'perPage', 'minPrice', 'maxPrice',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function mount($productCategory = null, $tag = null, $discount = null)
    {
        $this->productCategory = $productCategory;
        $this->tag = $tag;
        $this->discount = $discount;

        $this->priceMin = Product::min('price') ?? 0;
        $this->priceMax = Product::max('price') ?? 0;

        $this->minPrice = $this->priceMin;
        $this->maxPrice = $this->priceMax;
    }

    public function render()
    {
        $query = Product::with('category');

        // Search
        if ($this->search) {
            $query->where('name', 'like', "%{$this->search}%");
        }

        // Filter kategori
        if ($this->productCategory) {
            $query->whereHas('category', fn ($q) => $q->where('slug', $this->productCategory)
            );
        }

        // Filter tag
        if ($this->tag) {
            $query->where('tag', 'like', "%{$this->tag}%");
        }

        // Filter diskon
        if ($this->discount) {
            $query->where('discount_percentage', '>=', $this->discount);
        }

        // Filter harga
        $query->whereBetween('price', [$this->minPrice, $this->maxPrice]);

        // Sorting
        if ($this->sortBy === 'name') {
            $query->orderBy('name');
        } elseif ($this->sortBy === 'price') {
            $query->orderBy('price');
        }

        return view('livewire.superduper.pages.products', [
            'products' => $query->paginate($this->perPage),
            'categories' => ProductCategory::all(),
            'tags' => Product::select('tag')->distinct()->pluck('tag')->filter(),
        ])->layout('components.superduper.main');
    }

    public function viewProduct($id)
    {
        logger('viewProduct called', ['id' => $id]);

        $this->modalProduct = Product::with('category')->findOrFail($id);

        $this->dispatch('openModal', id: 'viewproduct-over');
    }

    public function resetFilters()
    {
        $this->reset(['search', 'sortBy', 'productCategory', 'tag', 'discount', 'minPrice', 'maxPrice']);
        $this->resetPage();
    }
}
