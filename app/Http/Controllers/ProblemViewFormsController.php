<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProblemViewFormsFormRequest;
use App\Models\ProblemViewForm;
use Exception;
use SimpleXMLElement;

// Pilabrem
class ProblemViewFormsController extends Controller
{

    /**
     * Display a listing of the problem view forms.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $problemViewForms = ProblemViewForm::paginate(10);

        return view('problem_view_forms.index', compact('problemViewForms'));
    }

    /**
     * Show the form for creating a new problem view form.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('problem_view_forms.create');
    }

    /**
     * Store a new problem view form in the storage.
     *
     * @param \App\Http\Requests\ProblemViewFormsFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(ProblemViewFormsFormRequest $request)
    {
        try {

            $data = $request->getData();

            ProblemViewForm::create($data);

            return redirect()->route('problem_view_forms.problem_view_form.index')
                ->with('success_message', trans('problem_view_forms.model_was_added'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('problem_view_forms.unexpected_error')]);
        }
    }

    /**
     * Display the specified problem view form.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $problemViewForm = ProblemViewForm::findOrFail($id);
        $problemInstanceFile = public_path("storage\\" . $problemViewForm->problem_instance);
        $xml = new SimpleXMLElement($problemInstanceFile, null, true);


        // dd(count($xml), $xml->attributes(), $xml);
        // dd($xml);


        $problemInstance = $xml;

        return view('problem_view_forms.show', compact('problemViewForm', 'problemInstance'));
    }

    /**
     * Show the form for editing the specified problem view form.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $problemViewForm = ProblemViewForm::findOrFail($id);


        return view('problem_view_forms.edit', compact('problemViewForm'));
    }

    /**
     * Update the specified problem view form in the storage.
     *
     * @param int $id
     * @param \App\Http\Requests\ProblemViewFormsFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($id, ProblemViewFormsFormRequest $request)
    {
        try {

            $data = $request->getData();

            $problemViewForm = ProblemViewForm::findOrFail($id);
            $problemViewForm->update($data);

            return redirect()->route('problem_view_forms.problem_view_form.index')
                ->with('success_message', trans('problem_view_forms.model_was_updated'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('problem_view_forms.unexpected_error')]);
        }
    }

    /**
     * Remove the specified problem view form from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $problemViewForm = ProblemViewForm::findOrFail($id);
            $problemViewForm->delete();

            return redirect()->route('problem_view_forms.problem_view_form.index')
                ->with('success_message', trans('problem_view_forms.model_was_deleted'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('problem_view_forms.unexpected_error')]);
        }
    }
}
