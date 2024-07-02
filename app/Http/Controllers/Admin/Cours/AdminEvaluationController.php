<?php

namespace App\Http\Controllers\Admin\Cours;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cours\EvaluationFormResquest;
use App\Models\Cours\Evaluation as CoursEvaluation;
use App\Models\Cours\Partie\Lesson;
use Illuminate\Support\Facades\Auth;

class AdminEvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lessons = Auth::user()->lessonsCreated;
        
        return view('cours.evaluations.index',[
            'lessons'=>$lessons,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Lesson $lesson)
    {
        $evaluation = new CoursEvaluation();
        return view('cours.evaluations.formulaire',[
            'evaluation'=>$evaluation,
            'lesson'=> $lesson,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EvaluationFormResquest $request,Lesson $lesson)
    {
        $data = $request->validated();
        $data['prof']=Auth::user()->id;
        $data['lesson_id']=$lesson->id;
        $data['statut_id']=1;

        try {
            $evaluation = CoursEvaluation::create($data);
            if($evaluation->exists)
                return to_route('prof.evaluations.index')->with('success','L\'evaluation a bien été Créer');
            else
                return back()->with('error',"Une erreurs inconnue est arriver");
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CoursEvaluation $evaluation)
    {
        
        return view('cours.evaluations.formulaire',[
            'evaluation'=>$evaluation,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EvaluationFormResquest $request, CoursEvaluation $evaluation)
    {
        $data = $request->validated();
        $data['prof']=Auth::user()->id;
        $data['lesson_id']=$evaluation->lesson_id;
        $data['statut_id']=$evaluation->statut_id;

        if($evaluation->update($data))
            return to_route('prof.evaluations.index')->with('success','L\'evaluation a bien été mise à jours');
        else
            return back()->with('error',"Une erreurs inconnue est arriver");
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CoursEvaluation $evaluation)
    {
        if($evaluation->delete())
            return to_route('prof.evaluations.index')->with('success','L\'evaluation a bien été Supprimer');
        else
            return back()->with('error',"Une erreurs inconnue est arriver");
    }
}
