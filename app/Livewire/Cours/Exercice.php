<?php

namespace App\Livewire\Cours;

use Livewire\Component;
use App\Models\Cours\Exercice as CoursExercice;

class Exercice extends Component
{

    public bool $is_open = False;
    public CoursExercice $exercice;
    public int $i = 0;

    function mount(CoursExercice $exercice,int $i){
        $this->exercice = $exercice;
        $this->i = $i;
    }

    function toggle(){
        $this->is_open = !$this->is_open;
    }

    public function render()
    {
        return view('livewire.cours.exercice',[
           'exercice' => $this->exercice
        ]);
    }
}
