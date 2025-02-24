@section('title', 'ایجاد محصول')

<div class="d-flex justify-content-center row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">فرم ایجاد محصول</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form wire:submit.prevent="storeProduct" class="form-horizontal">
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="inputEmail3" class="control-label mb-1">عنوان محصول</label>
                        <input type="name" name="title" class="form-control @error('title') is-invalid @enderror" wire:model.debounce.500ms="title" id="inputEmail3" placeholder="عنوان محصول را وارد کنید">
                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="inputEmail3" class="control-label mb-1">برند</label>
                        <input type="name" name="brand" class="form-control @error('brand') is-invalid @enderror" wire:model.debounce.500ms="brand" id="inputEmail3" placeholder="برند محصول را وارد کنید (اختیاری)">
                        @error('brand')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="inputEmail3" class="control-label mb-1">مدل ساخت</label>
                        <input type="number" name="build_model" class="form-control @error('build_model') is-invalid @enderror" wire:model.debounce.500ms="build_model" id="inputEmail3" placeholder="مدل محصول را وارد کنید (اختیاری)">
                        @error('build_model')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="inputEmail3" class="control-label mb-1">توضیحات</label>
                        <textarea type="text" name="description" rows="5" class="form-control @error('description') is-invalid @enderror" wire:model.debounce.500ms="description" id="inputEmail3" placeholder="توضیحات محصول را وارد کنید"></textarea>
                        
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="inputEmail3" class="control-label mb-1">قیمت</label>
                        <input type="name" name="price" class="form-control @error('price') is-invalid @enderror" wire:model.debounce.500ms="price" id="inputEmail3" placeholder="قیمت محصول را وارد کنید (اختیاری)">
                        @error('price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="d-flex-block justify-content-end form-check form-switch mb-2">
                        <input class="form-check-input @error('available') is-invalid @enderror" type="checkbox" role="switch" id="flexSwitchCheckDefault" wire:model="available" value="1">
                        <label class="form-check-label" for="flexSwitchCheckDefault">محصول موجود باشد</label>
                        @error('available')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <label for="inputGroupFile04" class="control-label mb-1">تصاویر</label>
                    <div class="input-group mb-3" dir="ltr">
                        <input type="file" name="images[]" class="form-control @error('images') is-invalid @enderror @error('images.*') is-invalid @enderror" wire:model="images" id="inputGroupFile04" multiple>
                        <button class="btn btn-light rounded-end" wire:click="ClearAllImages" style="border-color: #ced4da;" type="button" id="inputGroupFileAddon04">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="clean" width="20px" height="20px" viewBox="0 0 256 256" xml:space="preserve">
                                <style type="text/css">
                                    <![CDATA[
                                    .st0 {
                                        fill: white;
                                    }

                                    .st1 {
                                        fill: gray;
                                    }
                                    ]]>
                                </style>
                                <path class="st1" d="M226.079,41.926c-0.884-5.277-3.761-9.888-8.101-12.983l-5.025-3.585c-3.4-2.425-7.409-3.707-11.594-3.707  c-6.469,0-12.563,3.131-16.305,8.376l-57.367,80.43l-14.13-10.079c-3.952-2.818-9.076-4.371-14.429-4.371  c-4.881,0-9.62,1.323-13.345,3.728l-10.504,6.782c-4.988,3.22-7.935,8.159-8.108,13.566c-2.918,0.769-5.544,2.401-7.496,4.762  c-0.477,0.577-11.797,14.298-22.697,29.591c-20.845,29.248-22.878,39.697-19.403,47.08c2.212,4.697,6.882,7.502,12.494,7.502  c0.324,0,0.652-0.009,0.997-0.026c2.356-0.127,4.721-0.192,7.029-0.192c0.813,0,1.616,0.008,2.41,0.023  c0.064,0.001,0.129,0.002,0.193,0.002c2.94,0,5.713-1.293,7.601-3.504c0.094,0.158,0.192,0.314,0.294,0.469  c1.548,2.313,3.99,3.874,6.738,4.313c5.918,0.94,11.446,2.369,16.901,4.368c0.56,0.205,1.128,0.357,1.701,0.458  c0.484,0.307,1.002,0.575,1.55,0.801c5.371,2.209,10.62,4.972,16.519,8.691c1.496,0.941,3.179,1.453,4.877,1.53  c0.747,1.545,1.898,2.913,3.41,3.934c9.245,6.236,17.978,12.126,28.687,12.126l0,0c4.828,0,9.68-1.258,14.418-3.736  c28.051-14.679,29.838-37.795,29.9-38.771c0.038-0.595,0.031-1.196-0.001-1.801c5.81-1.333,10.455-5.831,12.295-12.226l3.33-11.567  c2.692-9.354-1.252-20.67-9.178-26.324l-14.462-10.315l57.365-80.429C225.743,52.5,226.963,47.203,226.079,41.926z" />
                                <path class="st0" d="M179.311,171.143c1.521-5.285-0.897-12.223-5.375-15.416l-14.463-10.315c-4.477-3.193-5.527-9.47-2.334-13.947  l57.367-80.431c3.195-4.478,2.145-10.754-2.334-13.948l-5.025-3.584c-4.479-3.194-10.756-2.143-13.948,2.334l-57.367,80.43  c-3.192,4.478-9.471,5.528-13.948,2.334l-14.13-10.078c-4.479-3.194-11.922-3.366-16.543-0.383l-10.505,6.782  c-4.621,2.983-4.738,8.038-0.26,11.23l84.628,60.366c4.479,3.192,9.387,1.481,10.907-3.804L179.311,171.143z" />
                                <path class="st0" d="M163.316,198.863c0.149-2.348-1.293-5.387-3.207-6.752l-86.521-61.709c-1.915-1.365-4.706-1-6.206,0.813  c0,0-56.939,68.875-36.857,67.789c3.54-0.19,6.922-0.244,10.171-0.182c10.792-16.244,28.777-34.951,28.777-34.951  s-8.46,19.021-12.572,36.353c6.986,1.11,13.189,2.811,18.77,4.854c4.205-4.922,7.501-9.326,7.501-9.326  c-1.585,4.381-2.858,7.896-3.887,10.728c6.904,2.84,12.805,6.174,18.049,9.479c9.059-5.701,16.407-11.812,16.407-11.812  s-3.167,8.431-7.862,17.443c12.133,8.184,21.013,14.027,32.875,7.818C162.146,217.174,163.316,198.863,163.316,198.863z" />
                            </svg>
                        </button>

                        @error('images')
                            <span class="invalid-feedback" role="alert" dir="rtl">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        @error('images.*')
                            <span class="invalid-feedback" role="alert" dir="rtl">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <div wire:loading wire:loading.class="d-block" wire:target="images" class="w-100 mt-3" wire:ignore>
                            <div class="progress" id="progressbar" dir="ltr">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%">0%</div>
                            </div>
                        </div>
                        @if (!$errors->isNotEmpty() && $images)
                            <div class="d-flex w-100 mt-3" dir="rtl">
                                @foreach ($images as $image)
                                    <img class="w-25" src="{{ $image->temporaryUrl() }}">
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="form-group mb-3">
                        <label for="inputEmail3" class="control-label mb-1">متن پیش نمایش</label>
                        <input type="text" name="alt" class="form-control @error('alt') is-invalid @enderror" wire:model.debounce.500ms="alt" id="inputEmail3" placeholder="متن پیش نمایش را وارد کنید (اختیاری)">
                        @error('alt')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">ثبت محصول</button>
                    <a href="{{ route('admin.users.all') }}" class="btn btn-danger float-left">لغو</a>
                </div>
                <!-- /.card-footer -->
            </form>
        </div>
    </div>
</div>

@section('script')
    <script>
        document.addEventListener('livewire:load' , () => {
            let progressSection = document.querySelector('#progressbar'),
                progressBar = progressSection.querySelector('.progress-bar')
            document.addEventListener('livewire-upload-start' , () => {
                console.log('upload start');
            });
            document.addEventListener('livewire-upload-finish' , () => {
                console.log('upload finish');
            });
            document.addEventListener('livewire-upload-error' , () => {
                console.log('upload error');
                progressBar.classList.add('bg-danger');
                progressBar.textContent = 'خطا هنگام بارگذاری';
            });
            document.addEventListener('livewire-upload-progress' , (event) => {
                console.log(`${event.detail.progress}%`);
                progressBar.style.width = `${event.detail.progress}%`;
                progressBar.textContent = `${event.detail.progress}%`;
            });
        })
    </script>
@endsection
