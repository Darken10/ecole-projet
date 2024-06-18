<?php

namespace App\Livewire\Cours;

use Livewire\Component;
use App\Models\Cours\Question;
use Illuminate\Support\Collection;
use App\Livewire\Cours\QcmResponse;
use App\Models\Cours\Evaluation;
use App\Models\Cours\Response;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\PseudoTypes\True_;

class QCM extends Component
{
    public Question $question;
    public Evaluation $evaluation;

    public string $question_text;
    public string $questionText="";
    public array $responsesTable = [];
    public int $questionPoint = 1; 

    function mount(Question $question,Evaluation $evaluation){
        $this->question=$question;
        $this->questionText = $this->question->text ?? '';
        $this->evaluation = $evaluation;
        foreach ($this->question->responses as  $response) {
            $this->responsesTable[]=[
                'text'=>$response->text,
                'isCorrect'=>$response->is_correct,
            ];
        }
    }

     function saveQuestion(){
        $data = [
            'question'=>$this->question_text ?? ''
        ];
        $this->question->update($data);
     }

    function addQcmResponse(){
        
        $this->responsesTable[] = [
            'text'=>'',
            'isCorrect'=>false,
        ];
    }

    function removeQcmResponse(int $index){
        unset($this->responsesTable[$index]);
    }

    function save(){
        $this->validate([
            'questionText'=>['required','string','min:3'],
            'questionPoint'=>['required','integer','min:0','max:100'],
            'responsesTable'=>['required','min:2'],
            'responsesTable.*.text'=>['required','string','min:3'],
            'responsesTable.*.isCorrect'=>['required','boolean'],
        ]);

        $this->responsesTable=($this->supprimerDoublon($this->responsesTable));
        
        $correct = array_filter($this->responsesTable,function ($response){
            return $response['isCorrect'];
        });

        if (!$this->question->exists){
            $this->question = Question::create([
                'text'=> $this->questionText,
                'point'=>$this->questionPoint,
                'user_id'=>Auth::user()->id,
                'type_question_id'=>count($correct)>1 ? 2 : 1,
                'evaluation_id'=>$this->evaluation->id,
            ]);
        }else {
            foreach ($this->responsesTable as $response) {
                /** @var Response $resp description */
                if($resp=Response::query()->where('text',$response['text'])->where('question_id',$this->question->id)->get()->last()){
                    $resp->update([
                        'is_correct' => $response['isCorrect']
                    ]); 
                } else{

                    $this->question->responses()->create([
                        'text'=>$response['text'],
                        'is_correct'=>$response['isCorrect'],
                        'user_id'=>Auth::user()->id,
                    ]);
                }
                $this->question->update([
                    'text'=> $this->questionText,
                    'point'=>$this->questionPoint,
                    'type_question_id'=>count($correct)>1 ? 2 : 1,
                ]); 
            }
            
            $this->reset(['questionText','responsesTable']);
            session()->flash('success','Votre Question à bien été créer');
        } 
    }

    private function supprimerDoublon(array $a){
        $unique = [];
        foreach ($a as $row) {
            $key = $row['text'];
            if(!isset($unique[$key])){
                $unique[$key] = $row;
            }
        }
        foreach ($unique as $value) {
            $ok[]=$value;
        }
        return $ok;
    }

    public function render()
    {
        return view('livewire.cours.q-c-m');
    }
}
