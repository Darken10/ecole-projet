<?php

namespace App\Livewire\Cours;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Cours\Exercice as CoursExercice;

class Exercice extends Component
{

    public bool $is_open = False;
    public CoursExercice $exercice;
    public int $i = 0;
    public array $user_responses = [];

    function mount(CoursExercice $exercice,int $i){
        $this->exercice = $exercice;
        $this->i = $i;
    }

    function toggle(){
        $this->is_open = !$this->is_open;
    }

    function correction(Request $request){
        //dd('corriger');
        $res = $request->input();
        dd($res);
        

    }

    function corrigeQcmSimple(){
        foreach ($this->exercice->questions as $key => $value) {
            if(array_key_exists($key,$this->user_responses)){
                dd($this->user_responses);
            }
        }
    } 

    public function render()
    {
        return view('livewire.cours.exercice',[
           'exercice' => $this->exercice
        ]);
    }
}
