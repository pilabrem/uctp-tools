<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


class SolutionViewFormsFormRequest extends FormRequest
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
            'solution_instance' => ['file'],
            'day_begin' => 'required',
            'time_slot' => 'required|numeric|min:-2147483648|max:2147483647',
            'day_time_slots' => 'required|numeric|min:-2147483648|max:2147483647',
            'week_days' => 'required|string|min:1',
            'semester_weeks' => 'required|numeric|min:-2147483648|max:2147483647',
        ];
        if ($this->route()->getAction()['as'] == 'solution_view_forms.solutionviewform.store' || $this->has('custom_delete_solution_instance')) {
            array_push($rules['solution_instance'], 'required');
        }
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
        $data = $this->only(['day_begin', 'time_slot', 'day_time_slots', 'week_days', 'semester_weeks']);
        if ($this->has('custom_delete_solution_instance')) {
            $data['solution_instance'] = '';
        }
        if ($this->hasFile('solution_instance')) {
            $data['solution_instance'] = $this->moveFile($this->file('solution_instance'));
        }


        return $data;
    }

    /**
     * Moves the attached file to the server.
     *
     * @param Symfony\Component\HttpFoundation\File\UploadedFile $file
     *
     * @return string
     */
    protected function moveFile($file)
    {
        if (!$file->isValid()) {
            return '';
        }

        $path = config('laravel-code-generator.files_upload_path', 'uploads');
        $saved = $file->store('public/' . $path, config('filesystems.default'));

        return substr($saved, 7);
    }
}
