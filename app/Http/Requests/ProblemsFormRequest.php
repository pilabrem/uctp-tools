<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProblemsFormRequest extends FormRequest
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
            'name' => 'required|string|min:1|max:255',
            'nr_days' => 'required|numeric|min:-2147483648|max:2147483647',
            'nr_weeks' => 'required|numeric|min:-2147483648|max:2147483647',
            'slots_per_day' => 'required|numeric|min:-2147483648|max:2147483647',
            'begin_hour' => 'required|numeric|min:-2147483648|max:2147483647',
            'week_days' => 'required|string|min:1',
            'minutes_per_slot' => 'required|numeric|min:-2147483648|max:2147483647',
            'time_optimization' => 'required|numeric|min:-2147483648|max:2147483647',
            'room_optimization' => 'required|numeric|min:-2147483648|max:2147483647',
            'distribution_optimization' => 'required|numeric|min:-2147483648|max:2147483647',
            'student_optimisation' => 'required|numeric|min:-2147483648|max:2147483647',
            'is_random' => 'nullable',
            'problem_class' => 'nullable',
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
        $data = $this->only(['name', 'nr_days', 'nr_weeks', 'slots_per_day', 'begin_hour', 'week_days', 'minutes_per_slot', 'time_optimization', 'room_optimization', 'distribution_optimization', 'student_optimisation', 'is_random', 'problem_class']);

        return $data;
    }
}
