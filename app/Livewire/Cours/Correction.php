<?php

namespace App\Livewire\Cours;

use App\Models\Cours\Corriger;
use Livewire\Component;
use App\Models\Cours\Question;
use App\Models\Cours\Evaluation;
use App\Models\Cours\Soumission;
use Illuminate\Database\Eloquent\Collection;


class Correction extends Component
{
    public Evaluation $evaluation;
    public array $responses = [];
    public Collection $soumissions;
    public Soumission|null $soumission;

    function mount(int $evaluation_id)
    {
        $this->evaluation = Evaluation::findOrFail($evaluation_id);
        $this->soumissions = Soumission::query()
            ->where('evaluation_id', $evaluation_id)
            ->where('user_id', auth()->user()->id)
            ->get();
        $this->soumission =  $this->soumissions?->last() ?? null;
    }

    function valider()
    {
        if ($this->soumissions->isEmpty()) {
            $this->soumission = Soumission::create([
                'evaluation_id' => $this->evaluation->id,
                'user_id' => auth()->user()->id,
            ]);
        }

        $this->corrigerQuestion();
        //$this->corrigerQuestion();
    }

    public function render()
    {
        return view('livewire.cours.correction');
    }

    private function corrigerQuestion()
    {
        $note = 0;
        foreach ($this->evaluation->questions as $question) {
            switch ($question->type_question_id) {
                case 1:
                    $note = $note + $this->corrigerQcmSimple($question); 
                    //dump($this->corrigerQcmSimple($question));
                    break;
                case 2:
                    $note = $note+ $this->corrigerQcmMutiple($question);
                    //dump($this->corrigerQcmMutiple($question));
                    break;
                case 3:
                    //$note = $note + $this->corrigerQuestionOuverte($question);
                    $note = $note + $this->corrigerQuestionOuverte($question);
                    break;

                default:
                    # code...
                    break;
            }
        }
        $this->soumission->note = $note;
        $this->soumission->save();
    }

    private function corrigerQcmSimple(Question $question): float
    {
        $point = 0;

        if(key_exists($question->id,$this->responses)){
            $corriger = $this->createCorrigerQcmSimple($question->id);
            foreach ($question->responses as $response) {
                if ($response->is_correct and $this->responses[$question->id] == $response->id) {
                    $point = $question->point;
                }
            }
        }
        return $point;
    }

    private function corrigerQcmMutiple(Question $question): float|bool
    {
        $point = 0;
        $corriger = $this->createCorrigerQcmMultiple($question->id);
        $cor = $question->responses()->where('is_correct',True)->pluck('is_correct','id')->toArray();
        if(key_exists($question->id,$this->responses)){
            $resultat = ($this->compare($this->responses[$question->id],$cor));
            if($resultat['sameCount'] and count($resultat['different'])==0){
                $point = $question->point;
            }else{
              $p = $question->point / count($cor) ; 
              $point = $p * count($resultat['same']);
            }
        }
        return $point;
    }

    private function corrigerQuestionOuverte(Question $question): float|bool{
        $point = 0;
        $corriger = $this->createCorrigerQuestionOuverte($question->id);
        if(strtolower(trim($question->responses()->get()->last()->text))===strtolower(trim($this->responses[$question->id]))){
            $point = $question->point;
        };
        return $point;
    }

    private function createCorrigerQcmSimple(int $question_id):Corriger{
        $corriger =  Corriger::query()->where('soumission_id',$this->soumission->id)->where('question_id',$question_id)->get()->last();
        $data = [
            'soumission_id' => $this->soumission->id,
            'question_id' => $question_id,
            'response_id' => $this->responses[$question_id],
        ];
        if($corriger?->id==null){
            $corriger = Corriger::create($data);
        }else{
            $corriger->update($data);
        }
        
        return $corriger;
    }

    private function createCorrigerQcmMultiple(int $question_id):Corriger{
        $corriger =  Corriger::query()->where('soumission_id',$this->soumission->id)->where('question_id',$question_id)->get()->last();
        if($corriger?->id==null){
            $corriger =  Corriger::create([
                'soumission_id' => $this->soumission->id,
                'question_id' => $question_id,
            ]);
        }
        
        $res = [];
        if(key_exists($question_id,$this->responses)){
            foreach ($this->responses[$question_id] as $response=>$value) {
                if($value){
                    $res[] = $response;
                }
            }
        }
        $corriger->response()->sync($res);
        return $corriger;
        
    }

    private function createCorrigerQuestionOuverte(int $question_id):Corriger{
        $corriger =  Corriger::query()->where('soumission_id',$this->soumission->id)->where('question_id',$question_id)->get()->last();
        
        if(key_exists($question_id,$this->responses)){
            $data = [
                'soumission_id' => $this->soumission->id,
                'question_id' => $question_id,
                'response_text' => $this->responses[$question_id],
            ];
            if($corriger?->id==null){
                $corriger = Corriger::create($data);
            }else{
                $corriger->update($data);
            }
        }
        return $corriger;
    }

    private function compare(array $array1, array $array2){
        $same = $differnent = [];
        foreach ($array1 as $key => $value) {
            if(array_key_exists($key,$array2) and $array2[$key]==$value){
                $same[$key]=$value;
            }else{
                $differnent[$key]=$value;
            }
        }
        $sameCount = false;
        if(count($array1) === count($array2)){
            $sameCount = True;
        }
        return ['same'=>$same,'different'=>$differnent,'sameCount'=>$sameCount];
    }

}
