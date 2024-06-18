<?php

use App\Http\Controllers\Admin\Classe\MatiereController;
use App\Http\Controllers\Admin\Cours\AdminEvaluationController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


//Route::resource('/eleve',EleveController::class)->except(['show','edit','create'])->middleware('auth');

// Administrateur 
Route::prefix('/admin')->group(function () {
    Route::resource('matiere',MatiereController::class);
    Route::resource('users',ClasseController::class);
});

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
