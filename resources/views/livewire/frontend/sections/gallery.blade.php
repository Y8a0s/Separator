<section data-aos="zoom-in" class="container mb-5" wire:init="loadGallery">

    <div class="d-flex align-items-center mb-5">
        <div class="col section-hr-r"></div>
        <h2 class="col-auto mx-2 text-nowrap fs-4" style="color: darkblue">گالری تصاویر</h2>
        <div class="col section-hr-l"></div>
    </div>

    @if ($readyToLoad)
        @php
            $max = 17;
        @endphp

        <div id="gallery">
            @for ($n = 1; $n <= $max; $n++)
                <div>
                    <img src="{{ Storage::url("images/gallery/$n.jpg") }}" alt="">
                    <a href="#lightbox-{{ $n }}">{{ $n }}</a>
                </div>
            @endfor
        </div>

        @for ($n = 1; $n <= $max; $n++)
            <div class="lightbox" id="lightbox-{{ $n }}">
                <div class="content">
                    <img src="{{ Storage::url("images/gallery/$n.jpg") }}" alt="">
                    <div class="text-center">
                        picture
                        <b>#{{ $n }}</b>
                        from Separator Sanaat AliMohammadi
                    </div>
                    <a href="#gallery" class="close"></a>
                </div>
            </div>
        @endfor
    @else
        <div class="d-flex justify-content-center align-items-center" style="height: 20rem">
            <span class="loader"></span>
        </div>
    @endif
</section>
