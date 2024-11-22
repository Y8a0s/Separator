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
            <div class="card mt-5">
                <div class="card-header">
                    <h5 class="my-1 text-secondary">ورود به حساب</h5>
                </div>

                <div class="card-body">
                    <form wire:submit.prevent="Login">

                        <div class="row m-0 mb-3">
                            <label for="phone" class="col-form-label text-md-end">شماره موبایل :</label>

                            <div class="col-md">
                                <input id="phone" type="tel" wire wire:model.debounce.1000ms="phone" class="form-control @error('phone') is-invalid @enderror">

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row m-0 mb-1">
                            <label for="password" class="col-form-label text-md-end">رمز عبور :</label>

                            <div class="col-md">
                                <input id="password" type="password" wire wire:model.debounce.1000ms="password" class="form-control @error('password') is-invalid @enderror">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="px-2 mb-3">
                            <a href="{{ route('auth.register') }}" class="link-primary text-decoration-none" style="font-size: 0.8rem">قبلا عضو نشده اید؟ برای عضویت کلیک کنید.</a>
                        </div>

                        {{-- <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        به خاطر سپردن
                                    </label>
                                </div>
                            </div>
                        </div> --}}

                        <div class="row mb-0">
                            <div class="d-flex justify-content-center w-100">
                                <button type="submit" class="btn btn-primary">
                                    ورود
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
