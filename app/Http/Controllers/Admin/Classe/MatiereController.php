<?php

namespace App\Http\Controllers\Admin\Classe;

use App\Models\Matiere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\Classe\Classe;
use App\Http\Controllers\Controller;

class MatiereController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $matieres = Matiere::all()->first();
        $m = DB::table('classes')
            ->select()
            ->join('classe_matiere','classes.id','=','classe_matiere.classe_id')
            ->join('matieres','matieres.id','=','classe_matiere.matiere_id')
            ->where('classes.id',1)
            ->where('matieres.id',1)
            ->get();
        $classe = Classe::first()->matiere->pivot;
        dd($classe);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Matiere $matiere)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Matiere $matiere)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Matiere $matiere)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Matiere $matiere)
    {
        //
    }
}
