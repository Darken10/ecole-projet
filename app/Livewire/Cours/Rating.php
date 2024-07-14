<?php

namespace App\Livewire\Cours;

use App\Models\User;
use Livewire\Component;
use App\Models\Cours\Partie\Lesson;
use Illuminate\Support\Facades\Auth;

class Rating extends Component
{


    public $lesson;
    public $apreciation;
    public $hasRated = false;

    public function mount(Lesson $lesson)
    {
        $this->lesson = $lesson;
        $this->checkIfUserHasRated();
    }

    public function checkIfUserHasRated()
    {
        /** @var User $user description */
        $user = Auth::user();
        $apreciation = $user->lessons()->where('lesson_id', $this->lesson->id)->first()?->pivot->apreciation;
        if ( $apreciation!=0) {
            $this->hasRated = true;
            $this->apreciation = $apreciation;
        }
    }

    public function setRating($apreciation)
    {
        $this->apreciation = $apreciation;
    }

    public function submitRating()
    {
        $this->validate([
            'apreciation' => 'required|integer|min:0|max:5',
        ]);
        
      
        Auth::user()->lessons()->updateExistingPivot($this->lesson->id, ['apreciation' => $this->apreciation]);
        $this->hasRated = true;
    }



    public function render()
    {
        return view('livewire.cours.rating');
    }
}
