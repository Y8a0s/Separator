<?php

namespace App\Http\Livewire\Admin\Products;

use App\Models\Product;
use Livewire\Component;

class Single extends Component
{
    public Product $product;

    public function render()
    {
        return view('livewire.admin.products.single');
    }
}