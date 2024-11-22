<div class="container">

    <div wire:offline class="alert alert-warning text-center w-100">
        <span>
            در حال حاضر شما آفلاین هستید.
            <i class="fs-5 bi bi-wifi-off"></i>
            <br>
            لطفا اتصال اینترنت خود را چک نمایید.
        </span>
    </div>

    <div class="row justify-content-center" wire:offline.class="d-none">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="my-1 text-secondary">ایجاد حساب</h5>
                </div>

                <div class="card-body">
                    <form wire:submit.prevent="Register">

                        <div class="row m-0 mb-3">
                            <label for="name" class="col-form-label">نام شما :</label>

                            <div class="col-md">
                                <input id="name" type="text" wire:model.debounce.500ms="name" class="form-control @error('name') is-invalid @enderror">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row m-0 mb-3">
                            <label for="last_name" class="col-form-label">نام خانوادگی :</label>

                            <div class="col-md">
                                <input id="last_name" type="text" wire:model.debounce.500ms="last_name" class="form-control @error('last_name') is-invalid @enderror">

                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row m-0 mb-3">
                            <label for="phone" class="col-form-label">شماره موبایل :</label>

                            <div class="col-md">
                                <input id="phone" type="tel" wire:model.debounce.1000ms="phone" class="form-control @error('phone') is-invalid @enderror">

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row m-0 mb-3">
                            <label for="password" class="col-form-label">رمز عبور :</label>

                            <div class="col-md">
                                <input id="password" type="password" wire:model.debounce.1000ms="password" class="form-control @error('password') is-invalid @enderror">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row m-0 mb-1">
                            <label for="password_confirmation" class="col-form-label">تکرار رمز :</label>

                            <div class="col-md">
                                <input id="password_confirmation" type="password" wire:model.debounce.1000ms="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">

                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="px-2 mb-3">
                            <a href="{{ route('auth.login') }}" class="link-primary text-decoration-none" style="font-size: 0.8rem">قبلا عضو شده اید؟ برای ورود کلیک کنید.</a>
                        </div>

                        <div class="row my-4">
                            <div class="d-flex justify-content-center col-md-8 w-100">
                                <button type="submit" class="btn btn-primary">
                                    ثبت نام
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
