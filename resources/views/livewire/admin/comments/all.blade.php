@section('title', 'نظرات')

@section('script')
    <script>
        document.addEventListener('livewire:load', function() {

            $(document).on("click", ".delete-comment", function() {
                commentId = $(this).val();
                userName = $(this).parent().parent().find('.name').html();
                $("#modal-ok-buttom").attr("wire:click", `deleteComment(${commentId})`);
                $("#modal .modal-title").html(`حذف نظر کاربر ${userName}`);
                $("#modal .modal-body").html('<p>آیا از <span class="text-danger">حذف</span> این نظر اطمینان دارید؟</p> <p>با این کار تمام پاسخ های آن نیز حذف خواهد شد!</p>');
            });

            $(document).on("click", ".reject-comment , .accept-comment", function() {
                commentId = $(this).val();
                userName = $(this).parent().parent().find('.name').html();
            });

            $(document).on("click", ".reject-comment", function() {
                $("#modal-ok-buttom").attr("wire:click", `rejectComment(${commentId})`);
                $("#modal .modal-title").html(`<i class="bi bi-x-lg text-danger"></i> رد نظر ${userName}`);
                $("#modal .modal-body").html('<p>آیا از <span class="text-danger">رد</span> نظر این کاربر اطمینان دارید؟</p>');
            });

            $(document).on("click", ".accept-comment", function() {
                $("#modalForm").attr("wire:submit.prevent", `acceptComment(${commentId})`);
                $("#modal2 .modal-title").html(`<i class="bi bi-check2 text-success"></i> تائید نظر ${userName}`);
            });

            $(document).on('click', '#modal2 .modal-ok-buttom', function() {
                setTimeout(() => {
                    $('#modal2').hide();
                    $('.modal-backdrop').remove();
                    $('body').removeClass('modal-open');
                    $('body').css('overflow', 'scroll');
                }, 500);
            });
        });
    </script>
@endsection

<div class="card h-100 shadow-sm">
    @include('layouts.admin.modal')
    @include('layouts.admin.reply-modal')
    <!-- /.modals -->

    <div class="card-header">
        <h3 class="card-title">نظرات</h3>
        <div class="card-tools d-flex flex-wrap justify-content-between mb-3">

            <form wire:submit.prevent="searchComments" class="d-flex ms-2">
                <div class="input-group ms-2" dir="ltr">
                    <button class="btn btn-primary border border-secondary" id="search-button" type="submit"><i class="bi bi-search btn-sm"></i></button>
                    <input type="text" wire:model.defer="search" class="form-control" placeholder="جست و جو..." dir="rtl">
                </div>
                <select wire:model="filterBy" wire:click="searchComments()" class="form-select form-select-sm h-100 text-start" style="width: min-content" dir="ltr">
                    <option class="text-center" value="all" selected>همه</option>
                    <option class="text-center" value="accepted">تائید شده</option>
                    <option class="text-center" value="unaccepted">رد شده</option>
                    <option class="text-center" value="notChecked">بررسی نشده</option>
                </select>
            </form>

            <button wire:click="deleteRejectedComments()" class="btn btn-sm btn-danger mt-4 mt-md-0">
                حذف رد شده ها
                <i class="bi bi-trash-fill position-relative" style="top: 2px"></i>
            </button>
        </div>
    </div>
    <!-- /.card-header -->
    <div wire:init="loadComments" class="cart-body row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3 py-3 px-2 rounded h-100">
        @if (!empty($comments->items()))
            @if ($readyToLoad)
                @foreach ($comments as $comment)
                    <div class="col">
                        <div>
                            <div class="bubble d-flex flex-column align-items-center shadow @if ($comment->accepted == 'Yes') bg-success-subtle @elseif($comment->accepted == 'No') bg-danger-subtle @else bg-warning-subtle @endif">
                                <div class="d-flex align-items-center px-2 w-100">
                                    <img class="rounded-circle  shadow  ms-2 border border-1" src="{{ is_null($comment->user->image) ? Storage::url('images/users/default-users-image.png') : Storage::url($comment->user->image) }}" height="30" width="30" alt="Image Description">
                                    <span class="text-break name"><small>{{ $comment->user->name }} {{ $comment->user->last_name }}</small></span>

                                    <span class="text-muted me-auto"><small>{{ jdate($comment->created_at)->ago() }}</small></span>
                                </div>

                                <hr class="my-2">

                                <p class="text-break">>{!! nl2br($comment->comment) !!}</p>

                                <div class="btn-group btn-group-sm mt-auto" style="width: min-content" role="group" dir="ltr">
                                    <button type="button" class="btn btn-outline-danger delete-comment" data-bs-toggle="modal" data-bs-target="#modal" value="{{ $comment->id }}">
                                        <i class="bi bi-trash position-relative" style="top: 2px"></i>
                                    </button>

                                    @if ($comment->parent_id != 0) 
                                        <button type="button" class="btn btn-outline-primary" data-bs-title="{{ $comment->parent()->user->name . ' ' . $comment->parent()->user->last_name . ' (' . jdate($comment->parent()->created_at)->ago() . ')' }}" data-bs-content="{{ $comment->parent()->comment }}" data-bs-toggle="popover"  data-bs-placement="top">
                                            <i class="bi bi-info-lg position-relative" style="top: 2px"></i>
                                        </button>
                                    @endif

                                    @if (is_null($comment->accepted) || $comment->accepted == 'Yes')
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#modal" class="btn btn-outline-danger reject-comment" value="{{ $comment->id }}">
                                            <i class="bi bi-x-lg position-relative" style="top: 2px"></i>
                                        </button>
                                    @endif

                                    @if (is_null($comment->accepted) || $comment->accepted == 'No')
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#modal2" class="btn btn-outline-success accept-comment" value="{{ $comment->id }}">
                                            <i class="bi bi-check2 position-relative" style="top: 2px"></i>
                                        </button>
                                    @endif
                                </div>
                            </div>
                            <div class="pointer @if ($comment->accepted == 'Yes') bg-success-subtle @elseif($comment->accepted == 'No') bg-danger-subtle @else bg-warning-subtle @endif"></div>
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
        {{ $comments->links() }}
    </div>
    <!-- /.card-footer -->

</div>
