<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentsFormRequest;
use App\Models\Problem;
use App\Models\Student;
use Exception;
use Illuminate\Support\Facades\URL;

// Pilabrem
class StudentsController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            // dd($request->problem_id);

            $problem = Problem::findOrFail($request->problem_id);
            URL::defaults(['problem_id' => $problem->id]);
            view()->share('problem', $problem);

            return $next($request);
        });
    }

    /**
     * Display a listing of the students.
     *
     * @return \Illuminate\View\View
     */
    public function index($problem_id)
    {
        return redirect()->route('problems.problem.students', $problem_id);
    }

    /**
     * Show the form for creating a new student.
     *
     * @return \Illuminate\View\View
     */
    public function create($problem_id)
    {
        $problems = Problem::pluck('name', 'id')->all();

        return view('students.create', compact('problems'));
    }

    /**
     * Store a new student in the storage.
     *
     * @param \App\Http\Requests\StudentsFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store($problem_id, StudentsFormRequest $request)
    {
        try {

            $data = $request->getData();

            Student::create($data);

            return redirect()->route('problems.problem.students', $problem_id)
                ->with('success_message', trans('students.model_was_added'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('students.unexpected_error')]);
        }
    }

    /**
     * Display the specified student.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($problem_id, $id)
    {
        $student = Student::with('problem')->findOrFail($id);

        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified student.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($problem_id, $id)
    {
        $student = Student::findOrFail($id);
        $problems = Problem::pluck('name', 'id')->all();

        return view('students.edit', compact('student', 'problems'));
    }

    /**
     * Update the specified student in the storage.
     *
     * @param int $id
     * @param \App\Http\Requests\StudentsFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($problem_id, $id, StudentsFormRequest $request)
    {
        try {

            $data = $request->getData();

            $student = Student::findOrFail($id);
            $student->update($data);

            return redirect()->route('problems.problem.students', $problem_id)
                ->with('success_message', trans('students.model_was_updated'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('students.unexpected_error')]);
        }
    }

    /**
     * Remove the specified student from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($problem_id, $id)
    {
        try {
            $student = Student::findOrFail($id);
            $student->delete();

            return redirect()->route('problems.problem.students', $problem_id)
                ->with('success_message', trans('students.model_was_deleted'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('students.unexpected_error')]);
        }
    }
}
