<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Illuminate\Support\Str;

class SingleProduct extends Component
{
    public Product $product;

    public function downloadImage($imgSrc)
    {
        return Storage::disk('public')->download($imgSrc);
    }

    public function render()
    {
        $this->seo()
            ->setTitle($this->product->title)
            ->setDescription($this->product->description)
            ->opengraph()->setUrl(url()->current());

        if ($this->product->images) {
            $images = json_decode($this->product->images);
            foreach ($images as $key => $img)
                $images[$key] = env('APP_URL') . Storage::url($img);

            $this->seo()->opengraph()->addImages($images);
            $this->seo()->jsonLd()->addImage($images[0]);
        }

        $this->seo()->opengraph()->addProperty('type', 'product');
        $this->seo()->jsonLd()->setType('product');

        return view('livewire.frontend.single-product');
    }
}
