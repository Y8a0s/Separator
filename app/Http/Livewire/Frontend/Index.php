<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;

class Index extends Component
{
    public $readyToLoad = false;

    public function loadGallery()
    {
        $this->readyToLoad = true;
    }

    public function render()
    {
        $this->seo()
            ->setTitle('صفحه اصلی')
            ->setDescription('سپاراتور صنعت علی محمدی با بیش از 15 سال سابقه حرفه ای در سراسر ایران در زمینه خرید و فروش (خط کامل یا تک ماشین آلات لبنی) , تولید , تعمیر , سرویس و مشاوره بصورت تخصصی مفتخر است که همچنان در کنار شماست.')
            ->opengraph()->setUrl(url()->current());

        return view('livewire.frontend.index');
    }
}
