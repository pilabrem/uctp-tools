<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class RoomsFormRequest extends FormRequest
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
        $rules = [
            'id_room' => 'string|min:1|nullable',
            'capacity' => 'numeric|min:-2147483648|max:2147483647|nullable',
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
        $data = $this->only(['id_room', 'capacity', 'problem_id']);

        return $data;
    }
}
