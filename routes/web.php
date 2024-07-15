<?php

use App\Models\Cours\Exercice;
use App\Models\Cours\Question;
use App\Models\Cours\Evaluation;
use App\Models\Cours\Partie\Lesson;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Chat\MessageController;
use App\Http\Controllers\Cours\LessonController;
use App\Http\Controllers\Contact\ContactController;
use App\Http\Controllers\Cours\EvaluationController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\Admin\Classe\MatiereController;
use App\Http\Controllers\Admin\Cours\AdminEvaluationController;


//
/* Route::prefix('/prof')->middleware(['auth', 'verified'])->name('prof.')->group(function () {
    Route::resource('evaluations',AdminEvaluationController::class)->except(['show','store','create']);
    Route::get('evaluations/{lesson}',[AdminEvaluationController::class,'create'])->name('evaluations.create');
    Route::post('evaluations/{lesson}',[AdminEvaluationController::class,'store'])->name('evaluations.store');
});
 */
// Client



Route::get('/test',function(){
    //$lesson  = Lesson::find(3);
    //dd();
})->middleware(['auth', 'verified']);


Route::middleware('auth')->group(function () {
    Route::get('/evaluation/{evaluation}',[EvaluationController::class,'index'])->name('evaluation.index');
    Route::post('/evaluation/{evaluation}',[EvaluationController::class,'correction'])->name('evaluation.correction');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/contact',[ContactController::class,'contact'])->name('contact.contact');


Route::prefix('/user')->controller(UserProfileController::class)->middleware('auth')->group(function () {
    Route::get('/profile', 'profile')->name('user.profile');
    Route::get('/profile/{user}',  'prof_profile')->name('user.profile.prof_profile');
    Route::get('/profile/reset-password',  'reset_password')->name('user.profile.reset-password');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/** Chat (Conversation) */
Route::prefix('/conversations')->name('chat.')->middleware(['auth', 'verified'])->controller(MessageController::class)->middleware(['auth',])->group(function (){
    Route::get('/','index')->name('index');
    Route::get('/user/{user}','show')->name('show')
    ->where([
        'user'=>'[0-9]+',
    ]);
    Route::post('/user/{user}','store')->name('store')->where([
        'user'=>'[0-9]+',
    ]);

});



/**connection avec google */
Route::get('redirect/google',function (){
    return Socialite::driver('google')->redirect();
});

Route::get('callback/google',function (){
    $user = Socialite::driver('google')->user();
    dd($user);
});

Route::prefix('/payment')->controller(PaymentController::class)->name('payment.')->group(function (){
    Route::get('/','lancer_payment')->name('payment');
    Route::get('/return_url','return_function')->name('return_url');
    Route::get('/cancel_url','cancel_function')->name('cancel_url');
    Route::get('/callback_url','callback_function')->name('callback_url');
});


Route::prefix('/')->name('cours.')->middleware(['auth', 'verified'])->controller(LessonController::class)->group(function (){
    Route::get('/','index')->name('index');
    Route::get('/mes-cours','mes_cours')->name('mes_cours');
    Route::get('/{lesson}','show')->name('show');
    Route::get('/{lesson}/like','like')->name('like');
    Route::get('/{lesson}/appreciation','appreciation')->name('appreciation');
    Route::get('/{lesson}/suivre','suivre')->name('suivre');
    Route::get('/{lesson}/{content}/{numero}/suivre','sectionSuivante')->name('sectionSuivante');
    Route::get('/{lesson}/{content}/{numero}/arriere','sectionArriere')->name('sectionArriere');
    Route::post('/{lesson}/question','user_question')->name('user_question');
    Route::post('/{exercice}/correction','exercice_corretion')->name('exercice_corretion');
    Route::get('/{lesson}/evaluation','evaluations_list')->name('evaluation.list');
    Route::get('/{evaluation}/faire-evaluation','evaluation')->name('evaluation');
    Route::post('/{evaluation}/evaluation','soumettre')->name('soumettre');
    Route::get('/{evaluation}/evaluation/show','evaluation_voir')->name('evaluation_voir');
});



require __DIR__.'/auth.php';
