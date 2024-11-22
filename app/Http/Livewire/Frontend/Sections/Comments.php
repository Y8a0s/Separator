<?php

namespace App\Http\Livewire\Frontend\Sections;

use App\Models\Comment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Comments extends Component
{
    use AuthorizesRequests;

    public $comment;
    public $reply;
    public $parent_id = 0;
    public $comments;
    public $num = 8; //comment ha chand ta chand ta nshon dade bshn
    public $counter = 0; //ye shomarande sade

    protected $validationAttributes = [
        'comment' => 'متن نظر'
    ];

    protected $listeners = [
        'refresh' => '$refresh'
    ];

    public function mount()
    {
        $this->comments = Comment::where('accepted', 'Yes')
            ->where('parent_id', 0)
            ->latest()
            ->orderBy('id', 'desc')
            ->limit($this->num)
            ->get();
    }

    public function submitComment()
    {
        $validated = $this->validate([
            'comment' => ['required', 'max:500']
        ]);

        if (auth()->user()->isAdmin() || auth()->user()->isSuperUser())
            $validated['accepted'] = 'Yes';

        $new_comment = auth()->user()->comments()->create($validated);

        if (auth()->user()->isAdmin() || auth()->user()->isSuperUser())
            $this->comments = $this->comments->prepend($new_comment);

        $this->emit('simpleToast', 'success', 'ارسال موفق', 'پیام شما با موفقیت ثبت شد و پس از بررسی نمایش داده خواهد شد');
        $this->reset('comment');
    }

    public function submitReply()
    {
        $validated = $this->validate([
            'reply' => ['required', 'max:500'],
            'parent_id' => ['required', 'exists:comments,id']
        ], [
            'reply.required' => 'فیلد ارسال پاسخ نمیتواند خالی باشد.',
            'reply.max' => 'متن نمیتواند بیشتر از 500 کاراکتر باشد.'
        ]);

        $validated['comment'] = $validated['reply'];
        unset($validated['reply']);

        if (auth()->user()->isAdmin() || auth()->user()->isSuperUser())
            $validated['accepted'] = 'Yes';

        $created = auth()->user()->comments()->create($validated);

        $this->emit('simpleToast', 'success', 'ارسال موفق', 'پاسخ شما با موفقیت ثبت شد و پس از بررسی نمایش داده خواهد شد');
        $this->reset(['reply', 'parent_id']);
    }

    public function more()
    {
        $this->counter += $this->num;
        $next_comments = Comment::where('accepted', 'Yes')
            ->where('parent_id', 0)
            ->latest()
            ->orderBy('id', 'desc')
            ->skip($this->counter)
            ->limit($this->num)
            ->get();

        $this->comments = $this->comments->merge($next_comments);
        $this->emit('moreComments');
    }

    public function render()
    {
        return view('livewire.frontend.sections.comments');
    }
}
