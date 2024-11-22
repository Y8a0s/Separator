<?php

namespace App\Http\Livewire\Admin\Comments;

use App\Models\Comment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class All extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $readyToLoad = false;
    protected $query;
    public $search;
    public $filterBy = 'all';
    public $replyToUser;

    public function __construct()
    {
        $this->query = Comment::query();
    }

    public function searchComments()
    {
        $this->query = Comment::filterOrSearchComments($this->filterBy , $this->search);
    }

    public function loadComments()
    {
        if ($this->search != null || $this->filterBy != 'all')
            $this->searchComments();
        $this->readyToLoad = true;

        $this->dispatchBrowserEvent('load-popover-script'); //because popovers dosnt work before Becoming readyToLoad to true
        // this event is in bootstrap.js
    }

    public function acceptComment(Comment $comment)
    {
        if($this->replyToUser) 
        {
            $reply_id = $comment->parent_id == 0
                                                ? $comment->id
                                                : $comment->parent_id; // for reply to child comments

            auth()->user()->comments()->create([
                'comment' => $this->replyToUser,
                'parent_id' => $reply_id,
                'accepted' => 'Yes',
            ]);

            $this->reset('replyToUser');
        }

        $comment->update([
            'accepted' => 'Yes',
            'checked_by' => auth()->user()->id
        ]);
    }

    public function rejectComment(Comment $comment)
    {
        $comment->update([
            'accepted' => 'No',
            'checked_by' => auth()->user()->id
        ]);
    }

    public function deleteComment(Comment $comment)
    {
        if(count($comment->replys()->get()))
            $comment->replys()->delete();
        $comment->delete();

        $this->emit('simpleToast' , 'success' , 'حذف موفق' , 'پاسخ مورد نظر با موفقیت حذف شد');
    }

    public function deleteRejectedComments()
    {
        $this->authorize('delete-comments');
        Comment::where('accepted' , 'No')->delete();
    }

    public function render()
    {   
        $comments_id = Comment::all()->reject(function($item) {
            return $item->user->isAdmin() || $item->user->isSuperUser();
        })->pluck('id'); //id comments of simple users

        $comments = $this->query->whereIn('id' , $comments_id)->orderBy('id' , 'desc')->paginate(8); //latest doesnt work correctly       
        return view('livewire.admin.comments.all', compact('comments'));
    }
}