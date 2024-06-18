<?php

namespace App\Http\Requests\Cours;

use Illuminate\Foundation\Http\FormRequest;

class EvaluationFormResquest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return True;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'=>['required','string','min:2'],
            'description'=>['string','nullable',''],
            'note_max'=>['required','numeric','between:0,100'],
            'cote'=>['required','numeric','between:1,10'],
            'difficulty'=>['required','numeric','between:1,10'],
            'time'=>['string'],


        ];
    }
}
