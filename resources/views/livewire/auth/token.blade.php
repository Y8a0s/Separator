@section('title', 'تائید شماره تلفن')

@section('script')
    <script>
        document.addEventListener('livewire:load', () => {

            livewire.on('timer', () => {
                var minutes;
                var seconds;
                var set_inteval;

                const resendLink = document.getElementById('resendLink');
                resendLink.style.cssText += 'pointer-events: none; color: gray !important;';

                minutes = {{ env('SMS_RESEND_CODE_TIME') }} - 1;
                seconds = 60;
                document.getElementById('seconds').innerHTML = seconds;
                document.getElementById('minutes').innerHTML = minutes;
                set_inteval = setInterval(otp_timer, 1000);


                function otp_timer() {
                    seconds -= 1;
                    document.getElementById('seconds').innerHTML = seconds;
                    document.getElementById('minutes').innerHTML = minutes;
                    if (seconds == 0) {
                        if (minutes > 0) {
                            seconds = 60;
                            minutes -= 1;
                        } else {
                            minutes = 0;
                            document.getElementById('minutes').innerHTML = minutes;
                            clearInterval(set_inteval);
                            minutes = 0;
                            seconds = 0;
                            document.getElementById('seconds').innerHTML = '00';
                            document.getElementById('minutes').innerHTML = '0';

                            resendLink.style.cssText = 'text-decoration: none';
                        }
                    }
                }
            });

            Livewire.emit('timer');

            $('#leadToSubmit').on('click', function(){
                $("[type=submit]").click();
            })
        })
    </script>
@endsection

<div class="container">

    <div wire:offline class="alert alert-warning text-center w-100">
        <span>
            در حال حاضر شما آفلاین هستید.
            <i class="fs-5 bi bi-wifi-off"></i>
            <br>
            لطفا اتصال اینترنت خود را چک نمایید.
        </span>
    </div>

    @include('layouts.frontend.bootstrap-toast')
    {{-- BootStrap Toast --}}

    <div class="row justify-content-center" wire:offline.class="d-none">
        <div class="col-lg-6">
            <div class="card mt-5">
                <div class="card-header">
                    <h5 class="my-1 text-secondary">تائید شماره موبایل</h5>
                </div>

                <div class="card-body">
                    <form wire:submit.prevent="Token">

                        <div class="row m-0 mb-3">
                            <label for="token" class="col-form-label text-md-end">کد فعال سازی :</label>

                            <div class="col-md">
                                <input id="token" wire:model.debounce.500ms="token" class="form-control @error('token') is-invalid @enderror" placeholder="کد ارسالی را وارد کنید">

                                @error('token')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="d-none"></button>
                    </form>

                    <div class="d-flex px-3 mb-2">
                        <div class="d-flex btn-start-timer">
                            <button id="resendLink" class="border border-0 bg-white link-primary p-0 ms-1" wire:click="$emit('sendAgain')" wire:ignore>ارسال مجدد کد؟</button>
                            <div class="otp-timer align-self-center">
                                <span id="seconds">00</span>
                                <span class="dot">:</span>
                                <span id="minutes">0</span>
                            </div>
                        </div>

                        <button id="leadToSubmit" class="btn btn-primary me-auto">
                            تائید
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
