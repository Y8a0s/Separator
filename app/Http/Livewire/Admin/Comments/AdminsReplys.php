<?php

namespace App\Http\Livewire\Admin\Comments;

use App\Models\Comment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class AdminsReplys extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $readyToLoad = false;
    protected $query;
    public $search;
    public $replyToUser;

    public function __construct()
    {
        $this->query = Comment::query();
    }

    public function searchComments()
    {
        $this->query = Comment::filterOrSearchComments(null , $this->search);
    }

    public function loadComments()
    {
        if ($this->search != null)
            $this->searchComments();
        $this->readyToLoad = true;

        $this->dispatchBrowserEvent('load-popover-script'); //because popovers dosnt work before Becoming readyToLoad to true
        // this event is in bootstrap.js
    }

    public function edit(Comment $comment)
    {
        $this->fill([
            'replyToUser' => $comment->comment
        ]);
    }

    public function update(Comment $comment)
    {
        $validated = $this->validate([
            'replyToUser' => 'required'
        ]);

        $comment->update([
            'comment' => $validated['replyToUser']
        ]);

        $this->emit('simpleToast' , 'success' , 'ویرایش موفق' , 'تغییرات مورد نظر با موفقیت اعمال شد');
    }

    public function deleteReply(Comment $comment)
    {
        if(count($comment->replys()->get()))
            $comment->replys()->delete();
        $comment->delete();

        $this->emit('simpleToast' , 'success' , 'حذف موفق' , 'پاسخ مورد نظر با موفقیت حذف شد');
    }

    public function render()
    {   
        $comments_id = Comment::all()->filter(function($item) {
            return $item->user->isAdmin() || $item->user->isSuperUser();
        })->pluck('id'); //id comments of simple users

        $comments = $this->query->whereIn('id' , $comments_id)->orderBy('id' , 'desc')->paginate(8); //latest doesnt work correctly       
        return view('livewire.admin.comments.admins-replys' , compact('comments'));
    }
}
