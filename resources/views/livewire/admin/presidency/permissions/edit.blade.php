@section('title', 'ویرایش دسترسی')


<div class="d-flex justify-content-center row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">فرم ویرایش دسترسی</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form wire:submit.prevent="updatePermission" class="form-horizontal">
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="inputEmail3" class="control-label mb-1">عنوان دسترسی</label>
                        <input type="name" name="name" class="form-control @error('name') is-invalid @enderror" wire:model.debounce.500ms="name" id="inputEmail3" placeholder="عنوان دسترسی را وارد کنید">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="inputEmail3" class="control-label mb-1">شرح دسترسی</label>
                        <input type="name" name="label" class="form-control @error('label') is-invalid @enderror" wire:model.debounce.500ms="label" id="inputEmail3" placeholder="شرح دسترسی را وارد کنید">
                        @error('label')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">ویرایش دسترسی</button>
                    <a href="{{ route('admin.presidency.permissions.all') }}" class="btn btn-danger float-left">لغو</a>
                </div>
                <!-- /.card-footer -->
            </form>
        </div>
    </div>
</div>
