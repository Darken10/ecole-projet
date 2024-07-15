<?php

namespace App\Livewire\Cours;

use Livewire\Component;
use App\Models\Cours\Partie\Lesson;
use App\Models\Cours\Comment as CoursComment;

class Comment extends Component
{

    public Lesson $lesson;
    public string $message = '';
    public int $i=0;
    
    function mount(Lesson $lesson){
        $this->$lesson = $lesson;
    }

    function save(){
        $this->i ++; // pour pouvoir rerendre le composant
        if($this->message!=''){
            CoursComment::create([
                'message'=>$this->message,
                'user_id'=>auth()->user()->id,
                'lesson_id'=>$this->lesson->id,
            ]); 
        }
        $this->reset(['message']);
    }

    function like($id){
        $this->i++;
        /** @var User $user description */
        $user = auth()->user();
        $user->user_likes()->attach($id);
    }

    public function render()
    {
        return view('livewire.cours.comment',[
            'lesson'=>$this->lesson,
            'comments'=>$this->lesson->comments,
            'i'=>$this->i,
            'message'=>$this->message,
        ]);
    }
}
