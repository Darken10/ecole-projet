<?php

namespace App\Http\Controllers\Cours;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    
    function index(){
        
        return view('cours.client.cours.index',[

        ]);
    }
}
