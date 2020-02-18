<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMatchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //ToDo: add only one 3 allowed, add one must be 3
        return [
            'home_score' => "required|numeric|max:3|min:0",
            'away_score' => "required|numeric|max:3|min:0",
            'password' => "required"
        ];
    }
}
