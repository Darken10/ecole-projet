<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'numero' => ['required', 'string', 'max:255'],
            'profile_uri' => ['nullable', 'string', 'max:255'],
            'date_naissance' => ['required', 'date', 'max:255'],
            'sexe' => ['required', 'string', 'max:25'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'name' => strtoupper(trim($request->first_name)).' '.$request->last_name,
            'numero' => $request->numero,
            'date_naissance' => $request->date_naissance,
            'sexe' => $request->sexe,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile_uri'=> $request->profile_uri ?? null,
            'niveau_id'=>$request->niveau_id,
        ]);

        $user->roles()->attach(1);
        $user->sendEmailVerificationNotification();

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('cours.index', absolute: false));
    }
}
