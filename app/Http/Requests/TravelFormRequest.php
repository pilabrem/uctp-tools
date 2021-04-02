<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


class TravelFormRequest extends FormRequest
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
            'room_id' => 'nullable',
            'travel_to_id' => 'nullable',
            'value' => 'numeric|min:-2147483648|max:2147483647|nullable',
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
        $data = $this->only(['room_id', 'travel_to_id', 'value']);

        return $data;
    }
}
