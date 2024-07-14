<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserProfileController extends Controller
{
    function profile(){

        return view('user.profile',[
            'user'=>auth()->user(),
        ]);
    }

    public function reset_password(){
        
        return view('user.updated-password');
    }
}
