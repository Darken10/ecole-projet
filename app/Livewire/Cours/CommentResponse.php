<?php

namespace App\Livewire\Cours;

use Livewire\Component;
use App\Models\Cours\Comment;
use App\Models\cours\CommentResponse as CoursCommentResponse;

class CommentResponse extends Component
{
    public Comment $comment;
    public int $i = 0;
    public string $response = "";

    function mount(Comment $comment){
        $this->comment = $comment;
    }

    function save(){
        $this->i ++; // pour pouvoir rerendre le composant
        if($this->response!=''){
            CoursCommentResponse::create([
                'message'=>$this->response,
                'user_id'=>auth()->user()->id,
                'comment_id'=>$this->comment->id,
            ]); 
        }
        $this->reset(['response']);
    }

    function like(){
        $this->i++;
        $this->comment->attach([auth()->user()->id]);
    }

    public function render()
    {
        return view('livewire.cours.comment-response',[
            'comment'=>$this->comment,
            'i'=>$this->i,
        ]);
    }
}
