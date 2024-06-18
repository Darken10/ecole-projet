<?php

namespace App\Livewire\Cours;

use Livewire\Component;
use App\Models\Cours\Evaluation;
use Illuminate\Support\Facades\Auth;
use App\Models\Cours\Question as CoursQuestion;

class Question extends Component
{

    public CoursQuestion $question;
    public Evaluation $evaluation;
    public string $questionText;
    public string $responseText = '';
    public int $questionPoint = 1;

    public function mount(CoursQuestion $question,Evaluation $evaluation){
        $this->question = $question;
        $this->evaluation = $evaluation;
        $this->questionText = $question->text ?? '';
        $this->questionPoint = $question->point ?? 1;
        //$this->responseText = $question->responses[0]->text;
    }

    public function save(){
        $this->validate([
            'questionText'=>['required','string','min:3'],
            'responseText'=>['required','string','min:3'],
            'questionPoint'=>['required','integer','min:0','max:100'],
        ]);
        
        if (!$this->question->exists){
            $this->question = CoursQuestion::create([
                'text'=> $this->questionText,
                'point'=>$this->questionPoint,
                'user_id'=>Auth::user()->id,
                'type_question_id'=>3,
                'evaluation_id'=>$this->evaluation->id,
            ]);
            $this->question->responses()->create([
                'text'=>$this->responseText,
                'is_correct'=>True,
                'user_id'=>Auth::user()->id,
            ]);
        }else {
            $this->question->update([
                'text'=> $this->questionText,
                'point'=>$this->questionPoint,
                'type_question_id'=>3,
            ]); 
        }
        $this->reset(['questionText','responseText']);
        session()->flash('success','Votre Question à bien été créer');
    }

    public function render()
    {
        return view('livewire.cours.question');
    }
}
