@section('title', 'ویرایش کاربر')


<div class="d-flex justify-content-center row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">فرم ویرایش کاربر</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form wire:submit.prevent="updateUser" class="form-horizontal">
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="inputEmail3" class="control-label mb-1">نام کاربر</label>
                        <input type="name" name="name" class="form-control @error('name') is-invalid @enderror" wire:model.debounce.500ms="name" id="inputEmail3" placeholder="نام کاربر را وارد کنید">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="inputEmail3" class="control-label mb-1">نام خانوادگی کاربر</label>
                        <input type="name" name="last_name" class="form-control @error('last_name') is-invalid @enderror" wire:model.debounce.500ms="last_name" id="inputEmail3" placeholder="نام خانوادگی کاربر را وارد کنید">
                        @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="inputEmail3" class="control-label mb-1">شماره موبایل</label>
                        <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror" wire:model.debounce.500ms="phone" id="inputEmail3" placeholder="شماره موبایل کاربر را وارد کنید">
                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="password" class="col-form-label mb-1">رمز عبور</label>
                        <input id="password" type="password" wire:model.debounce.500ms="password" class="form-control @error('password') is-invalid @enderror" placeholder="رمز عبور کاربر را وارد کنید">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="password_confirmation" class="col-form-label mb-1">تکرار رمز</label>
                        <input id="password_confirmation" type="password" wire:model.debounce.500ms="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="تکرار رمز عبور کاربر را وارد کنید">
                        @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="d-flex form-check mb-2">
                        <label class="form-check-label text-nowrap mb-1" for="verified">اکانت فعال باشد</label>
                        <input type="checkbox" name="verified" class="form-check-input justify-content-end me-1 @error('verified') is-invalid @enderror" wire:model="verified" id="verified" value="1">
                        @error('verified')
                            <span class="invalid-feedback me-4" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">ویرایش کاربر</button>
                    <a href="{{ url()->previous() }}" class="btn btn-danger float-left" wire:ignore>لغو</a>
                </div>
                <!-- /.card-footer -->
            </form>
        </div>
    </div>
</div>
