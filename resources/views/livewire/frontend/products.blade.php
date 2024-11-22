<div class="rounded py-5">
    <div class="container">
        @foreach ($products as $product)
            @php

                if ($product->images != null) {
                    $images = json_decode($product->images);
                    $image = $images[0];
                } else {
                    $image = null;
                }

                ////////////////////////////////////////////////

                $difference = \Carbon\Carbon::parse($product->created_at)->floatDiffInHours(now());

            @endphp

            @if ($loop->odd)
                <div class="row mb-4 mb-md-5">
                    <div class="card machinery-card shadow p-0" data-aos="fade-left">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="{{ $image ? Storage::url($image) : Storage::url('images/products/default-products-image.jpg') }}" alt="{{ $product->alt }}" class="img-fluid rounded" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body d-flex flex-column h-100">
                                    <h5 class="card-title">{{ $product->title . ' ' . $product->brand }}</h5>
                                    <p class="card-text text-break @guest placeholder-glow pe-none @endguest">
                                        {{ Illuminate\Support\Str::limit($product->description, 100, '...') }}
                                    </p>
                                    <div class="d-flex justify-content-between mt-auto">
                                        <p class="card-text mb-0">
                                            @if ($difference <= 24)
                                                <small class="badge text-bg-danger fw-light">جدید</small>
                                            @else
                                                <small class="text-body-secondary">{{ jdate($product->created_at)->ago() }}</small>
                                            @endif
                                        </p>
                                        <a href="{{ route('machinery.details', ['product' => $product->id]) }}" class="link-primary text-decoration-none ms-3">جزئیات بیشتر</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row mb-4 mb-md-5" dir="ltr">
                    <div class="card machinery-card shadow p-0" data-aos="fade-right">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="{{ $image ? Storage::url($image) : Storage::url('images/products/default-products-image.jpg') }}" alt="{{ $product->alt }}" class="img-fluid rounded" alt="...">
                            </div>
                            <div class="col-md-8" dir="rtl">
                                <div class="card-body h-100">
                                    <h5 class="card-title">{{ $product->title . ' ' . $product->brand }}</h5>
                                    <p class="card-text text-break @guest placeholder-glow pe-none @endguest">
                                        {{ Illuminate\Support\Str::limit($product->description, 100, '...') }}
                                    </p>
                                    <div class="d-flex justify-content-between mt-auto">
                                        <p class="card-text mb-0">
                                            @if ($difference <= 24)
                                                <small class="badge text-bg-danger fw-light">جدید</small>
                                            @else
                                                <small class="text-body-secondary">{{ jdate($product->created_at)->ago() }}</small>
                                            @endif
                                        </p>
                                        <a href="{{ route('machinery.details', ['product' => $product->id]) }}" class="link-primary text-decoration-none ms-3">جزئیات بیشتر</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach

        <div class="d-flex justify-content-center w-100">
            {{ $products->links() }}
        </div>
    </div>
</div>
