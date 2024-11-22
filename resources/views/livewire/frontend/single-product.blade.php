@section('script')
    <script>
        document.addEventListener('livewire:load', function() {
            $(document).on("click", "#carousel a", function() {

                let imageSrc = $(this).find('img').attr('src'); // image path from storage folder
                let imagePath = imageSrc.substr(8); // image path from images folder (without /storage/)

                if ($("#imagesModal img")) {
                    $("#imagesModal img").remove()
                }

                $("#imagesModal .modal-body").append(`
                    <img src="${imageSrc}" class="d-none d-md-block h-100">
                    <img src="${imageSrc}" class="d-md-none w-100">
                `);
                $('#downloadImage').attr('wire:click', `downloadImage('${imagePath}')`);
            });

            $(document).on("click", "#imagesModal #downloadImage", function() {
                $(this).attr('disabled', 'disabled');
                setTimeout(() => {
                    $(this).removeAttr('disabled', 'disabled')
                }, 1000);
            });
        });
    </script>
@endsection

<div class="d-flex flex-column justify-content-center align-items-center h-100 px-md-5 px-lg-0">

    <!-- Images Modal -->
    <div class="modal fade" id="imagesModal" tabindex="-1" aria-labelledby="imagesModalLabel" aria-hidden="true" wire:ignore>
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-body d-flex flex-column justify-content-center align-items-center bg-dark">
                    <div class="d-flex align-content-center my-2 w-100">
                        <button type="button" class="btn btn-sm bg-light ms-2" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
                        <button type="button" class="btn btn-sm bg-light" id="downloadImage" wire:click=""><i class="bi bi-download"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="w-100 alert alert-warning text-center mb-5" style="max-width: 1000px" role="alert" data-aos="fade-down">
        <small>
            جهت اطلاع از جزئیات دیگر با شماره تلفن های درج شده در
            <a href="#contact-us" class="link-primary text-decoration-none">پایین صفحه</a>
            تماس حاصل فرمایید
        </small>
    </div>

    <div class="card w-100 align-self-center overflow-hidden mb-3" style="max-width: 1000px" data-aos="zoom-in">
        @if ($product->available)
            <div class="ribbon ribbon-top ribbon-left ribbon-sticky bg-success">موجود</div>
        @else
            <div class="ribbon ribbon-top ribbon-left ribbon-sticky bg-warning">ناموجود</div>
        @endif
        <div class="row w-100 g-0">
            <div class="col-lg-6">
                @php
                    if ($product->images != null) {
                        $images = json_decode($product->images);
                    } else {
                        $images = null;
                    }
                @endphp

                @if ($images)
                    <div id="carousel" class="carousel slide" data-bs-ride="carousel" dir="ltr">
                        <div class="carousel-indicators">
                            @foreach ($images as $image)
                                <button type="button" data-bs-target="#carousel" data-bs-slide-to="{{ $loop->index }}" @if ($loop->first) class="active" aria-current="true" @endif aria-label="Slide {{ $loop->index + 1 }}"></button>
                            @endforeach
                        </div>
                        <div class="carousel-inner">
                            @php
                                $time = 0;
                            @endphp

                            @foreach ($images as $image)
                                @php
                                    $time += 1000;
                                @endphp
                                <div class="carousel-item @if ($loop->first) active @endif" @if (!$loop->last) data-bs-interval="{{ $time }}" @endif>
                                    <a data-bs-toggle="modal" data-bs-target="#imagesModal">
                                        <img src="{{ Storage::url($image) }}" class="d-block img-fluid rounded w-100" alt="{{ $product->alt }}">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                @else
                    <img class="img-fluid rounded" src="{{ Storage::url('images/products/default-products-image.jpg') }}" alt="{{ $product->alt }}">
                @endif
            </div>
            <div class="col-lg-6">
                <div class="card-body d-flex flex-column h-100">

                    <h5 class="card-title pe-none">{{ $product->title }}</h5>
                    <hr>

                    <div class="d-flex my-3">
                        <div class="flex-fill">
                            <span class="card-text pe-none">برند :</span>
                            @auth
                                @if ($product->brand != '')
                                    <span class="card-text badge fw-normal bg-primary">{{ $product->brand }}</span>
                                @else
                                    <span class="card-text badge fw-normal bg-secondary px-4">-</span>
                                @endif
                            @endauth

                            @guest
                                <span class="card-text badge fw-normal bg-secondary">وارد حساب شوید</span>
                            @endguest
                        </div>
                        <div class="flex-fill">
                            <span class="card-text pe-none">مدل ساخت :</span>
                            @auth
                                @if (!is_null($product->build_model))
                                    <span class="card-text badge fw-normal bg-primary">{{ $product->build_model }}</span>
                                @else
                                    <span class="card-text badge fw-normal bg-secondary px-4">-</span>
                                @endif
                            @endauth

                            @guest
                                <span class="card-text badge fw-normal bg-secondary">وارد حساب شوید</span>
                            @endguest
                        </div>
                    </div>
                    <br>

                    <span class="card-title pe-none">توضیحات :</span>
                    <p class="card-text">{!! nl2br($product->description) !!}</p>

                    <div class="flex-fill d-flex align-items-center mb-3">
                        <span class="card-text pe-none">قیمت :</span>
                        @auth
                            @if ($product->price)
                                <span class="card-text badge fw-normal bg-success">{{ number_format($product->price) }} تومان</span>
                            @else
                                <span class="card-text badge fw-normal bg-secondary px-4">-</span>
                            @endif
                        @endauth

                        @guest
                            <span class="card-text badge fw-normal bg-secondary">وارد حساب شوید</span>
                        @endguest
                    </div>

                    @if ($images)
                        <div class="alert alert-info text-center pe-none mt-md-4" role="alert">
                            <small>برای نمایش کامل تصاویر روی آنها کلیک کنید</small>
                        </div>
                    @endif
                    <hr class="mt-auto">

                    <div class="d-flex justify-content-between">
                        <p class="card-text"><small class="text-body-secondary">{{ jdate($product->created_at)->ago() }}</small></p>
                        <a href="{{ route('machineries') }}" class="btn btn-sm btn-primary d-flex align-items-center ms-2" style="height: min-content">
                            بازگشت
                            <i class="bi bi-arrow-left align-middle me-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
