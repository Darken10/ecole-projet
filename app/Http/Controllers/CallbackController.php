<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class CallbackController extends Controller
{
    public function callbackGoogle(){
        try {
            $user = Socialite::driver('google')->user();

            dd($user);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect('/login')->withErrors("Erreur d'authentification a traver Google");
        }
    }
}
