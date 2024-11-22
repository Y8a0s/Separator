@section('title', 'جزئیات دستگاه')

<div class="d-flex justify-content-center">
    <div class="col col-md-6 col-lg-6">
        <div class="card h-100 shadow-sm">
            <div class="card-header">
                <h3 class="card-title">{{ $product->title }}</h3>
            </div>

            @php
                if ($product->images != null) {
                    $images = json_decode($product->images);
                } else {
                    $images = null;
                }
            @endphp

            @if ($images)
                <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel" dir="ltr">
                    <div class="carousel-indicators">
                        @foreach ($images as $image)
                            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="{{ $loop->index }}" @if ($loop->first) class="active" aria-current="true" @endif aria-label="Slide {{ $loop->index + 1 }}"></button>
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
                            <div class="carousel-item border @if ($loop->first) active @endif" @if (!$loop->last) data-bs-interval="{{ $time }}" @endif>
                                <img src="{{ Storage::url($image) }}" class="d-block border-bottom w-100" alt="{{ $product->alt }}">
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            @else
                <img class="card-img-top" src="{{ Storage::url('images/products/default-products-image.jpg') }}" alt="{{ $product->alt }}">
            @endif


            <!-- /.card-header -->
            <div class="cart-body fs-5 py-3 px-2 rounded">
                <div class="d-flex mb-3">
                    <div class="w-50">
                        <span class="fw-semibold">برند :</span>
                        <span class="badge fw-light text-bg-secondary">{{ $product->brand }}</span>
                    </div>
                    <div class="w-50">
                        <span class="fw-semibold">مدل :</span>
                        <span class="badge fw-light text-bg-secondary">{{ $product->build_model }}</span>
                    </div>
                </div>

                <hr>

                <p class="card-text text-break mb-3"><span class="fw-semibold">توضیحات : </span>{!! nl2br($product->description) !!}</p>

                <hr>

                <div class="row mb-3">
                    <div class="col">
                        <span class="fw-semibold">قیمت :</span>
                        @if ($product->price)
                            <span class="badge bg-success align-middle fw-normal">{{ number_format($product->price) }} تومان</span>
                        @else
                            <span class="badge bg-danger align-middle fw-normal">ثبت نشده</span>
                        @endif
                    </div>

                    <div class="col">
                        <span class="fw-semibold">وضعیت :</span>
                        @if ($product->available)
                            <span class="badge bg-success text-middle fw-normal">دستگاه موجود می باشد</span>
                        @else
                            <span class="badge bg-warning text-middle fw-normal">دستگاه موجود نمی باشد</span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- /.card-body -->
            <div class="card-footer d-flex justify-content-between align-items-center w-100">
                <div>
                    <span class="text-muted" style="font-size: 10px">
                        @if ($product->created_at == $product->updated_at)
                            ایجاد شده در
                            {{ Morilog\Jalali\CalendarUtils::strftime('H:m d-m-Y', strtotime($product->created_at)) }}
                        @elseif ($product->created_at != $product->updated_at)
                            آخرین بروز رسانی در
                            {{ Morilog\Jalali\CalendarUtils::strftime('H:m d-m-Y', strtotime($product->updated_at)) }}
                        @endif
                    </span>
                    <span class="text-muted" style="font-size: 10px">
                        توسط مهندس
                        {{ $product->user->name }}
                        {{ $product->user->last_name }}
                    </span>
                </div>
                <a href="{{ route('admin.products.all') }}" class="btn btn-sm btn-primary d-flex align-items-center" style="height: min-content">
                    بازگشت
                    <i class="bi bi-arrow-left align-middle me-1"></i>
                </a>
            </div>
        </div>
    </div>
</div>
