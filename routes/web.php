<?php

use App\Http\Controllers\Admin\Classe\MatiereController;
use App\Http\Controllers\Admin\Cours\AdminEvaluationController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\Cours\EvaluationController;
use App\Http\Controllers\Cours\LessonController;
use App\Http\Controllers\ProfileController;
use App\Models\Cours\Evaluation;
use App\Models\Cours\Exercice;
use App\Models\Cours\Question;
use Illuminate\Support\Facades\Route;


//Route::resource('/eleve',EleveController::class)->except(['show','edit','create'])->middleware('auth');

// Administrateur 
/*Route::prefix('/admin')->group(function () {
    Route::resource('matiere',MatiereController::class);
    Route::resource('users',ClasseController::class);
});
*/
//
Route::prefix('/prof')->middleware(['auth', 'verified'])->name('prof.')->group(function () {
    Route::resource('evaluations',AdminEvaluationController::class)->except(['show','store','create']);
    Route::get('evaluations/{lesson}',[AdminEvaluationController::class,'create'])->name('evaluations.create');
    Route::post('evaluations/{lesson}',[AdminEvaluationController::class,'store'])->name('evaluations.store');
});

// Client
Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/cours')->name('cours.')->controller(LessonController::class)->group(function (){
    Route::get('/','index')->name('index');
    Route::get('/{lesson}','show')->name('show');
    Route::get('/{lesson}/suivre','suivre')->name('suivre');
    Route::get('/{lesson}/{content}/{numero}/suivre','sectionSuivante')->name('sectionSuivante');
    Route::get('/{lesson}/{content}/{numero}/arriere','sectionArriere')->name('sectionArriere');
});

Route::get('/test',function(){
    $question = Question::find(2);
    $exo = Exercice::find(1);
    dd($exo->questions);
});


Route::middleware('auth')->group(function () {
    Route::get('/evaluation/{evaluation}',[EvaluationController::class,'index'])->name('evaluation.index');
    Route::post('/evaluation/{evaluation}',[EvaluationController::class,'correction'])->name('evaluation.correction');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
