<?php

namespace App\Livewire\Cours;

use Livewire\Component;
use App\Models\Cours\Evaluation;
use Illuminate\Support\Facades\Auth;
use App\Models\Cours\Question as CoursQuestion;

class Question extends Component
{

    public array $answers = [];
    public Evaluation $evaluation ;

    public function mount(Evaluation $evaluation){
        $this->evaluation = $evaluation;
    }

    public function soumettre(){
        
        $data = $this->validate([
            'answers'=>['required','min:2'],
            //'answers.*.text'=>['required','string','min:3'],
            //'answers.*.is_correct'=>['required','boolean'],
        ]);
        dd($this->answers);
        
        //session()->flash('success','Votre Question à bien été créer');
    }

    public function render()
    {
        return view('livewire.cours.question',[
            'evaluation'=>$this->evaluation
        ]);
    }
}
