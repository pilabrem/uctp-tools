<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


class ClassPossibleTimesFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // return Auth::check();
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'classe_id' => 'nullable',
            'days' => 'required|array',
            'start' => 'required|numeric|min:-2147483648|max:2147483647',
            'length' => 'required|numeric|min:-2147483648|max:2147483647',
            'weeks' => 'required|array',
            'penalty' => 'required|numeric|min:-2147483648|max:2147483647',
        ];

        return $rules;
    }
    
    /**
     * Get the request's data from the request.
     *
     * 
     * @return array
     */
    public function getData()
    {
        $data = $this->only(['classe_id', 'days', 'start', 'length', 'weeks', 'penalty']);

        return $data;
    }

}
