@section('title')
    <title>پروفایل | سپاراتور صنعت علی محمدی</title>
@endsection

@section('script')
    <script>
        document.addEventListener('livewire:load', function() {
            $(document).on('click', '#selectImage', function() {
                $('#fileInput').click();
            });

            $(document).on('click', '#deleteImage , #selectImage', function(e) {
                e.preventDefault();
            })
        })
    </script>
@endsection

<div class="container">

    @include('layouts.frontend.bootstrap-toast')
    {{-- BootStrap Toast --}}
    
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="my-1 text-secondary">اطلاعات شخصی</h5>
                </div>

                <form wire:submit.prevent="editProfile">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 d-flex flex-column justify-content-center align-items-center">

                                @php
                                    if (is_null($image)) {
                                        $url = Storage::url('images/users/default-users-image.png');
                                    }
                                    //default image for user
                                    elseif (is_string($image)) {
                                        $url = Storage::url($image);
                                    }
                                    //original and saved user image in db
                                    else {
                                        // object
                                        $url = $image->temporaryUrl(); //realtime uploaded image
                                    }
                                @endphp

                                <img class="rounded-pill border border-4 border-info mb-2" src="{{ $url }}" width="140" height="140" alt="{{ $user->name }}">
                                <input name="image" wire:model="image" type="file" class="d-none @error('image') is-invalid @enderror" id="fileInput">

                                <button wire:loading.remove wire:target="deleteImage" wire:click="deleteImage" class="border-0 bg-white @if (!is_null($image)) link-danger @endif" id="deleteImage" @if (is_null($image)) disabled @endif>حذف تصویر</button>
                                <div wire:loading wire:target="deleteImage" class="spinner-border spinner-border-sm text-danger mt-2" style="display: none" role="status">
                                    <span class="visually-hidden">در حال حذف تصویر...</span>
                                </div>

                                <button wire:loading.remove wire:target="image" class="border-0 bg-white link-primary" id="selectImage">انتخاب تصویر جدید</button>
                                <div wire:loading wire:target="image" class="spinner-border spinner-border-sm text-primary mt-2" style="display: none" role="status">
                                    <span class="visually-hidden">در حال آپلود تصویر...</span>
                                </div>

                                @error('image')
                                    <span class="invalid-feedback text-center" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-auto d-none d-md-flex">
                                <div class="vr"></div>
                            </div>
                            <div class="col-md px-4">
                                <div class="mb-3">
                                    <label class="form-label" for="name">نام :</label>
                                    <input wire:model.debounce.500ms="name" class="form-control @error('name') is-invalid @enderror" type="text" name="name" placeholder="نام خود را وارد کنید">

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="last_name">نام خانوادگی :</label>
                                    <input wire:model.debounce.500ms="last_name" class="form-control @error('last_name') is-invalid @enderror" type="text" name="last_name" placeholder="نام خانوادگی خود را وارد کنید">

                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="phone">شماره موبایل :</label>
                                    <input class="form-control text-muted" type="tel" name="phone" placeholder="شماره موبایل خود را وارد کنید" value="{{ $user->phone }}" disabled>
                                    <span class="form-text"><small>در حال حاضر امکان تغییر شماره موبایل وجود ندارد</small></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer" dir="ltr">
                        <button type="submit" class="btn btn-primary">اعمال تغییرات</button>
                        <a href="{{ route('home') }}" type="button" class="btn btn-secondary">لغو</a href="{{ route('home') }}" type="button">
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>
