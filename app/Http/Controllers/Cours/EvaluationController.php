<?php

namespace App\Http\Controllers\Cours;

use App\Http\Controllers\Controller;
use App\Models\Cours\Evaluation;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    function index(Evaluation $evaluation){
        return view('cours.client.evaluations.index',[
            'evaluation'=>$evaluation,
        ]);
    }

    function correction(Request $request,Evaluation $evaluation){
        dd($request->input());
    }
}
