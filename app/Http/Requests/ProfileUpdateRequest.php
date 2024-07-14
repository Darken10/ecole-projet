<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string','min:2', 'max:255'],
            'last_name' => ['required', 'string' ,'min:2', 'max:255'],
            'numero' => ['required', 'string','min:8', 'max:16'],
            'profile_uri' => ['nullable', 'string', 'max:255'],
            'niveau_id' => ['nullable', 'numeric'],
            'date_naissance' => ['required', 'date', 'max:255'],
            'sexe' => ['required', 'string', 'max:25'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        ];
    }
}
