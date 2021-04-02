<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


class RoomUnavailablesFormRequest extends FormRequest
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
            'days' => 'required|array',
            'start' => 'required|numeric|min:-2147483648|max:2147483647',
            'length' => 'required|numeric|min:-2147483648|max:2147483647',
            'weeks' => 'required|array',
            'room_id' => 'nullable',
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
        $data = $this->only(['days', 'start', 'length', 'weeks', 'room_id']);

        return $data;
    }

}
