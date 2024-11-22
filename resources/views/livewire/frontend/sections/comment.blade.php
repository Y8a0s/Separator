<div class="@if ($isReply == false) col-md-10 my-2 @elseif($isReply) d-none ms-md-4 my-1 reply-to-{{ $comment->parent_id }} @endif">
    <div class="d-flex">

        <img class="rounded-circle @if ($isReply == false) shadow @elseif($isReply) shadow-sm @endif ms-2 border border-2 border-secondary" src="{{ is_null($comment->user->image) ? Storage::url('images/users/default-users-image.png') : Storage::url($comment->user->image) }}" height="45" width="45" alt="Image Description">

        <div class="@if ($isReply == false) shadow bg-white @elseif($isReply) shadow-sm bg-light border @endif w-100 p-4 mt-4" style="border-radius: 10px 0 10px 10px">

            <div class="d-flex justify-content-between align-items-center">
                <span class="mb-0">{{ $comment->user->name }} {{ $comment->user->last_name }}</span>
                <span class="text-muted" style="font-size: 0.8rem">{{ $comment->created_at->diffInSeconds(now()) <= 60 ? 'لحظاتی پیش' : jdate($comment->created_at)->ago() }}</span>
            </div>

            <hr class="mt-1">

            <p class="text-break">
                {!! nl2br($comment->comment) !!}
            </p>

            <ul class="d-flex flex-wrap flex-wrap-reverse @if ($isReply == false && $comment->acceptedReplys()->count()) justify-content-between @else justify-content-end mb-0 @endif align-items-center px-0">
                @if ($isReply == false && $comment->acceptedReplys()->count())
                    <li class="list-inline-item">
                        <span class="link-primary show-replys" style="cursor: pointer" id="show-replys-of-{{ $comment->id }}">
                            <i class="bi bi-eye-fill position-relative" style="top: 2px"></i>
                            نمایش پاسخ ها ({{ $comment->acceptedReplys()->count() }})
                        </span>

                        <span class="d-none link-danger hide-replys" style="cursor: pointer" id="hide-replys-of-{{ $comment->id }}">
                            <i class="bi bi-eye-slash-fill position-relative" style="top: 2px"></i>
                            مخفی کردن
                        </span>
                    </li>
                @endif

                <li class="list-inline-item mb-1 mb-md-0">
                    @if ($isReply == false)
                        <a class="text-decoration-none link-primary reply" href="@guest #login-alert @endguest" @auth data-bs-toggle="modal" data-bs-target="#replyModal" data-bs-whatever="{{ $comment->id }}"  data-bs-whatever2="{{ $comment->user->name }}" @endauth>
                            <i class="bi bi-reply-fill fs-5 position-relative" style="top: 2px"></i>
                            پاسخ دادن
                        </a>
                        {{-- <div class="vr mx-2"></div> --}}
                    @endif
                    {{-- <a class="text-decoration-none link-success" href="@guest #login-alert @endguest">
                        <i class="bi bi-hand-thumbs-up"></i>
                        <i class="bi bi-hand-thumbs-up-fill"></i>
                        126
                    </a> --}}
                </li>
            </ul>

            <div class="d-flex flex-column-reverse">
                @if ($comment->acceptedReplys()->count() && $comment->parent_id == 0)
                    @foreach ($comment->acceptedReplys() as $reply)
                        @livewire('frontend.sections.comment', ['comment' => $reply, 'isReply' => true], key($reply->id))
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>