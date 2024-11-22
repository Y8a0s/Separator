<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{
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
        $this->query = Product::filterOrSearchProducts($this->filterBy, $this->search, $this->search);
    }

    public function render()
    {
        $products = $this->query->orderBy('id', 'desc')->paginate(8); //latest doesnt work correctly->paginate(8);

        $this->seo()
            ->setTitle('ماشین آلات')
            ->setDescription('خامه گیر و دستگاه های مربوطه صنف لبنیات مورد نیاز خود را بصورت در حد و یا استوک از ما بخواهید.')
            ->opengraph()->setUrl(url()->current());
       
        return view('livewire.frontend.products', compact('products'));
    }
}
