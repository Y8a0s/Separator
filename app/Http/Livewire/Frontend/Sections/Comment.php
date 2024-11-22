<?php

namespace App\Http\Livewire\Frontend\Sections;

use App\Models\Comment as ModelsComment;
use Illuminate\Http\Request;
use Livewire\Component;

class Comment extends Component
{
    public ModelsComment $comment;
    public $isReply = false; // change automatically

    public function render()
    {
        return view('livewire.frontend.sections.comment');
    }
}
