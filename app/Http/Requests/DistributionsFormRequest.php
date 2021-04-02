<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


class DistributionsFormRequest extends FormRequest
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
            'type' => 'required',
            'is_required' => 'required|boolean',
            'penalty' => 'nullable|numeric|min:-2147483648|max:2147483647',
            'param1' => 'nullable|numeric|min:-2147483648|max:2147483647',
            'param2' => 'nullable|numeric|min:-2147483648|max:2147483647',
            'problem_id' => 'nullable',
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
        $data = $this->only(['type', 'is_required', 'penalty', 'param1', 'param2', 'problem_id']);

        return $data;
    }

}
