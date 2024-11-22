@section('title', 'محصولات')

@section('script')
    <script>
        document.addEventListener('livewire:load', function() {
            $(document).on("click", ".delete-product", function() {
                var productId = $(this).val();
                $("#modal-ok-buttom").attr("wire:click", `deleteProduct(${productId})`);
                $("#modal .modal-title").html(`حذف محصول ${productId}`);
                $("#modal .modal-body").html('<p>آیا از <span class="text-danger">حذف</span> این محصول اطمینان دارید؟</p>');
            });
        })
    </script>
@endsection

<div class="card h-100 shadow-sm">

    @include('layouts.admin.modal')
    <!-- /.modal -->

    <div class="card-header">
        <h3 class="card-title">محصولات</h3>
        <div class="card-tools d-flex justify-content-between mb-3">

            <form wire:submit.prevent="searchProducts" class="d-flex ms-2">
                <div class="input-group ms-2" dir="ltr">
                    <button class="btn btn-primary border border-secondary" id="search-button" type="submit"><i class="bi bi-search btn-sm"></i></button>
                    <input type="text" wire:model.defer="search" class="form-control" placeholder="جست و جو..." dir="rtl">
                </div>
                <select wire:model="filterBy" wire:click="searchProducts()" class="form-select form-select-sm h-100 text-start" style="width: 95px" dir="ltr">
                    <option class="text-center" value="all" selected>همه</option>
                    <option class="text-center" value="available">موجود</option>
                    <option class="text-center" value="unavailable">ناموجود</option>
                </select>
            </form>

            @can('create-products')
                <a href="{{ route('admin.products.create') }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-plus-lg fs-5 align-middle" style="position: relative;top:3px"></i>
                    <span class="d-none d-lg-inline">محصول جدید</span>
                </a>
            @endcan
        </div>
    </div>
    <!-- /.card-header -->
    <div wire:init="loadProductsData" class="cart-body row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3 py-3 px-2 rounded h-100">
        @if (!empty($products->items()))
            @if ($readyToLoad)
                @foreach ($products as $product)
                    <div class="col">
                        <div class="card shadow-sm h-100" style="overflow: hidden">

                            @if ($product->available)
                                <div class="ribbon ribbon-top ribbon-left ribbon-sticky bg-success">موجود</div>
                            @else
                                <div class="ribbon ribbon-top ribbon-left ribbon-sticky bg-warning">ناموجود</div>
                            @endif

                            <div class="card-header">
                                <h5 class="card-title m-0">
                                    <span class="text-muted">{{ $product->id }})</span>
                                    {{ $product->title }}
                                </h5>
                            </div>

                            @php
                                if ($product->images != null) {
                                    $images = json_decode($product->images);
                                    $image = $images[0];
                                } else {
                                    $image = null;
                                }
                            @endphp
                            <img class="card-img-top" src="{{ $image ? Storage::url($image) : Storage::url('images/products/default-products-image.jpg') }}" alt="{{ $product->alt }}">
                            <div class="card-body d-flex flex-column justify-content-between bg-light">
                                <p class="card-text text-break">{{ Illuminate\Support\Str::limit($product->description, 150, '...') }}</p>
                                @if ($product->price)
                                    <p class="card-text badge bg-success text-break mt-auto fs-6 fw-normal">قیمت : {{ number_format($product->price) }} تومان</p>
                                @else
                                    <p class="card-text badge bg-danger text-break mt-auto fs-6 fw-normal">قیمت : ثبت نشده</p>
                                @endif
                                <div class="d-flex justify-content-between align-items-center" dir="ltr">
                                    <small class="text-muted text-center me-1" dir="rtl">{{ jdate($product->created_at)->ago() }}</small>
                                    <div class="btn-group">
                                        @can('delete-products')
                                            <button data-bs-toggle="modal" data-bs-target="#modal" value="{{ $product->id }}" class="delete-product btn btn-sm btn-outline-danger">حذف</button>
                                        @endcan
                                        <a type="button" href="{{ route('admin.products.single', ['product' => $product->id]) }}" class="btn btn-sm btn-outline-success">جزئیات</a>
                                        @can('edit-products')
                                            <a type="button" href="{{ route('admin.products.edit', ['product' => $product->id]) }}" class="btn btn-sm btn-outline-primary">ویرایش</a>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div>
                    <div class="lds-ellipsis">
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
            @endif
        @else
            <tr>
                <div class="d-sm-inline-block d-md-none text-muted fs-4 fw-bold" style="position: absolute; top:50%; right:25%">نتیجه ای یافت نشد :(</div>
                <div class="d-none d-md-inline-block d-lg-none text-muted fs-4 fw-bold" style="position: absolute; top:50%; right:38%">نتیجه ای یافت نشد :(</div>
                <div class="d-none d-lg-inline-block text-muted fs-4 fw-bold" style="position: absolute; top:50%; right:43%">نتیجه ای یافت نشد :(</div>
            </tr>
        @endif
    </div>

    <!-- /.card-body -->
    <div class="card-footer d-flex justify-content-center w-100">
        {{ $products->links() }}
    </div>
    <!-- /.card-footer -->

</div>
