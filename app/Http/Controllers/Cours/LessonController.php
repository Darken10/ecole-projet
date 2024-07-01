<?php

namespace App\Http\Controllers\Cours;

use App\Http\Controllers\Controller;
use App\Models\Cours\Lesson;
use App\Models\Matiere;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    
    function index(){
        
        $matieres = Matiere::all();
        return view('cours.client.lesson.index',[
            'matieres'=>$matieres
        ]);
    }

    function show(Lesson $lesson){

        return view('cours.client.lesson.show',[
            'lesson'=>$lesson
        ]);
    }
}
