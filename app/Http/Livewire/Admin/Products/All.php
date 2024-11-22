<?php

namespace App\Http\Livewire\Admin\Products;

use App\Models\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class All extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $readyToLoad = false;
    protected $query;
    public $search;
    public $filterBy = 'all';

    public function __construct()
    {
        $this->query = Product::query();
    }

    public function searchProducts()
    {
        $this->query = Product::filterOrSearchProducts($this->filterBy, $this->search);
    }

    public function loadProductsData()
    {
        if ($this->search != null || $this->filterBy != 'all')
            $this->searchProducts();
        $this->readyToLoad = true;
    }

    public function deleteProduct(Product $product)
    {
        $this->authorize('delete-products');

        if (!is_null($product->images)) {
            $images = json_decode($product->images);
            $dirOfImages = dirname($images[0]);
            if (Storage::disk('public')->directoryExists($dirOfImages))
                Storage::disk('public')->deleteDirectory($dirOfImages);
        }

        $product->delete();
    }

    public function render()
    {
        $products = $this->query->orderBy('id', 'desc')->paginate(8); //latest doesnt work correctly
        return view('livewire.admin.products.all', compact('products'));
    }
}
