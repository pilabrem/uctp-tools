<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


class ProblemViewFormsFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'problem_instance' => ['file'],
            'begin_hour' => 'required',
            'days' => 'required|string|min:1',
        ];
        if ($this->route()->getAction()['as'] == 'problem_view_forms.problemviewform.store' || $this->has('custom_delete_problem_instance')) {
            array_push($rules['problem_instance'], 'required');
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
        $data = $this->only(['begin_hour', 'days']);
        if ($this->has('custom_delete_problem_instance')) {
            $data['problem_instance'] = '';
        }
        if ($this->hasFile('problem_instance')) {
            $data['problem_instance'] = $this->moveFile($this->file('problem_instance'));
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
