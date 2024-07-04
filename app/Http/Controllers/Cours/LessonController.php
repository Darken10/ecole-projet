<?php

namespace App\Http\Controllers\Cours;

use App\Models\Matiere;
use Illuminate\Http\Request;
use App\Models\Cours\Partie\Lesson;
use App\Http\Controllers\Controller;
use App\Models\Cours\Partie\Content;

class LessonController extends Controller
{
    
    function index(){
        
        $matieres = Matiere::all();
        return view('cours.client.lesson.index',[
            'matieres'=>$matieres
        ]);
    }

    function show(Lesson $lesson){
        $lesson->addView();
        return view('cours.client.lesson.show',[
            'lesson'=>$lesson
        ]);
    }

    function suivre(Lesson $lesson){
        $lesson->addFollower();
        $content = $lesson->contents->first();
        $numero = 1;
        return view('cours.client.lesson.lesson',[
            'numero'=>$numero,
            'prev_content'=>  null,
            'lesson'=>$lesson,
            'content'=>$content,
            'next_content'=> $lesson->contents[1] ?? null,
            
        ]);
    }

    function sectionSuivante(Lesson $lesson, Content $content,int $numero){
        $numero = $numero + 1;
        return view('cours.client.lesson.lesson',[
            'numero'=>$numero,
            'prev_content'=>  $lesson->contents[$numero-1] ?? null,
            'lesson'=>$lesson,
            'content'=>$content,
            'next_content'=> $lesson->contents[$numero] ?? null
        ]);
    }

    function sectionArriere(Lesson $lesson, Content $content,int $numero){
        $numero = $numero + 1;
        return view('cours.client.lesson.lesson',[
            'numero'=>$numero,
            'prev_content'=>  $lesson->contents[$numero-2] ?? null,
            'lesson'=>$lesson,
            'content'=>$content,
            'next_content'=> $lesson->contents[$numero] ?? null
        ]);
    }



}
