<?php

namespace App\Livewire\Cours;

use App\Models\Cours\Evaluation;
use App\Models\Cours\Question;
use Livewire\Component;

class QcmResponse extends Component
{
    public Question $question;
    public Evaluation $evaluation;
    public int $i;
    
    function mount(Evaluation $evaluation,Question $question,int $i){
        $this->question = $question;
        $this->evaluation = $evaluation;
        $this->i=$i;
    }

    /*function submitResponse(){
        $data = [
            'response' => $this->response_text,
            
        ];
        $this->response->update($data);
        
        $this->question->responses()->updateExistingPivot($this->response->id,['is_good_response'=> $this->good_response]);
        $autre = $this->question->responses()->wherePivot('id','!=',$this->response->id)->get(); 

        foreach ($autre as $res) {
            $this->question->responses()->updateExistingPivot($res->id,['is_good_response'=>0]);
        }
    }*/
    
    public function render()
    {
        return view('livewire.cours.qcm-response',[
            'evaluation'=>$this->evaluation,
            'question'=>$this->question,

        ]);
    }
}
