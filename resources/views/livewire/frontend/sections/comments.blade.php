@section('script')
    <script>
        document.addEventListener("livewire:load", () => {
            Livewire.on('moreComments', postId => {
                showAndHideButtonsEvent();
            })

            showAndHideButtonsEvent();

            function showAndHideButtonsEvent() {
                $(".show-replys").click(function() {
                    var comment_id = $(this).attr('id').substr(15);
                    $(this).addClass('d-none'); //the show replys button
                    $("#hide-replys-of-" + comment_id).removeClass('d-none'); //the hide replys button
                    $(".reply-to-" + comment_id).removeClass('d-none'); //the every reply 
                });

                $(".hide-replys").click(function() {
                    var comment_id = $(this).attr('id').substr(15);
                    $(this).addClass('d-none'); // the hide replys button
                    $("#show-replys-of-" + comment_id).removeClass('d-none'); //the show button
                    $(".reply-to-" + comment_id).addClass('d-none'); //the every reply
                });
            }

            const replyModal = document.getElementById('replyModal')
            replyModal.addEventListener('show.bs.modal', event => { // set params on modal

                const button = event.relatedTarget
                const recipient = button.getAttribute('data-bs-whatever')
                const recipient2 = button.getAttribute('data-bs-whatever2')
                const modalTitle = replyModal.querySelector('.modal-title')
                const modalBodyInput = replyModal.querySelector('.modal-body input')

                modalTitle.textContent = `پاسخ به ${recipient2}`
                modalBodyInput.value = recipient

                modalBodyInput.dispatchEvent(new Event('input')); //for update input event and work livewire correctly
            });

            $("#modalSubmit").click(function() { //clear modal manually
                setTimeout(() => {
                    $('#replyModal').hide();
                    $('.modal-backdrop').remove();
                    $('body').removeClass('modal-open');
                    $('body').css('overflow', 'scroll');
                }, 2000);
            });

            $('#message-text').on('keyup', function() { //for disable modal submit button when field is empty
                let empty = false

                empty = $('#message-text').val().length == 0

                if (empty)
                    $('#modalSubmit').attr('disabled', 'disabled');
                else
                    $('#modalSubmit').attr('disabled', false);
            });
        });
    </script>
@endsection

<section>

    @include('layouts.frontend.reply-modal')
    @include('layouts.frontend.bootstrap-toast')
    <div data-aos="zoom-in" wire:ignore.self class="container mb-4">
        <div class="d-flex align-items-center mb-4">
            <div class="col section-hr-r"></div>
            <h2 class="col-auto mx-1 text-nowrap fs-4" style="color: darkblue">نظرات</h2>
            <div class="col section-hr-l"></div>
        </div>

        <p>
            <b>« نظرات شما »</b>
        </p>

        <div class="row content d-flex justify-content-center bg-light border rounded py-4" style="border-color: gray">

            @foreach ($comments as $comment)
                @livewire('frontend.sections.comment', ['comment' => $comment], key($comment->id))
            @endforeach

            <div class="col-md-10 my-4 text-center">
                <span wire:click="more()" style="cursor: pointer" class="link-primary">
                    نظرات بیشتر
                    <i class="bi bi-arrow-counterclockwise fs-5 position-relative" wire:loading.class="spin" wire:target="more" style="top: 4px"></i>
                </span>
            </div>

            <form class="col-md-10 d-flex flex-column my-2 align-middle" wire:submit.prevent="submitComment">
                <div class="d-flex mb-3">
                    <label for="commentTextarea" class="form-label ms-2 mt-2 text-nowrap">ارسال نظر:</label>
                    <div class="w-100">
                        <textarea name="comment" wire:model.defer="comment" class="form-control @error('comment') is-invalid @enderror" id="commentTextarea" placeholder="بنویسید..." rows="4"></textarea>
                        @error('comment')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                @auth
                    <button type="submit" class="btn btn-primary shadow-sm" style="margin-right: 4.5rem">ثبت</button>
                @endauth
            </form>

            @guest
                <div id="login-alert" class="col-md-10 alert alert-warning text-center shadow mt-4 mx-2" role="alert">
                    لطفا برای ثبت نظر ابتدا
                    <a class="text-decoration-none link-primary" href="{{ route('auth.login') }}">وارد حساب</a>
                    خود شوید و یا برای
                    <a class="text-decoration-none link-primary" href="{{ route('auth.register') }}">عضویت</a>
                    کلیک کنید.
                </div>
            @endguest
        </div>
    </div>
</section>
