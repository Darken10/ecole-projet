<?php

namespace App\Http\Controllers\User;

use App\Models\User;
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

    function prof_profile(User $user){

        return view('user.show-prof-profile',[
            'user'=>$user,
        ]);
    }
}
