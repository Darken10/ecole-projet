<?php

namespace App\Livewire\Login;

use Livewire\Component;

class EmailOrNumber extends Component
{

    public string $choix='numero';
    function change_choix(){
        $this->choix = $this->choix == "numero" ? "email" : "numero";
        //dd($this->choix);
    }
    public function render()
    {
        
        return view('livewire.login.email-or-number',[
        ]);
    }
}
