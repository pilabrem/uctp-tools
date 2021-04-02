<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentCoursesFormRequest;
use App\Models\Course;
use App\Models\Student;
use App\Models\StudentCourse;
use Exception;
use Illuminate\Support\Facades\URL;

// Pilabrem
class StudentCoursesController extends Controller
{

    protected $problem = null;
    protected $student = null;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            $student = student::findOrFail($request->student_id);
            $this->student = $student;
            $this->problem = $student->problem;
            URL::defaults(['student_id' => $student->id]);
            view()->share('student', $student);
            view()->share('problem', $this->problem);

            return $next($request);
        });
    }

    /**
     * Display a listing of the student courses.
     *
     * @return \Illuminate\View\View
     */
    public function index($student_id)
    {
        return redirect()->route('problems.problem.students', $this->problem->id);
    }

    /**
     * Show the form for creating a new student course.
     *
     * @return \Illuminate\View\View
     */
    public function create($student_id)
    {
        $students = Student::pluck('name', 'id')->all();
        $courses = Course::pluck('name', 'id')->all();

        return view('student_courses.create', compact('students', 'courses'));
    }

    /**
     * Store a new student course in the storage.
     *
     * @param \App\Http\Requests\StudentCoursesFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store($student_id, StudentCoursesFormRequest $request)
    {
        try {

            $data = $request->getData();

            StudentCourse::create($data);

            return redirect()->route('problems.problem.students', $this->problem->id)
                ->with('success_message', trans('student_courses.model_was_added'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('student_courses.unexpected_error')]);
        }
    }

    /**
     * Display the specified student course.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($student_id, $id)
    {
        $studentCourse = StudentCourse::with('student', 'course')->findOrFail($id);

        return view('student_courses.show', compact('studentCourse'));
    }

    /**
     * Show the form for editing the specified student course.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($student_id, $id)
    {
        $studentCourse = StudentCourse::findOrFail($id);
        $students = Student::pluck('name', 'id')->all();
        $courses = Course::pluck('name', 'id')->all();

        return view('student_courses.edit', compact('studentCourse', 'students', 'courses'));
    }

    /**
     * Update the specified student course in the storage.
     *
     * @param int $id
     * @param \App\Http\Requests\StudentCoursesFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($student_id, $id, StudentCoursesFormRequest $request)
    {
        try {

            $data = $request->getData();

            $studentCourse = StudentCourse::findOrFail($id);
            $studentCourse->update($data);

            return redirect()->route('problems.problem.students', $this->problem->id)
                ->with('success_message', trans('student_courses.model_was_updated'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('student_courses.unexpected_error')]);
        }
    }

    /**
     * Remove the specified student course from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($student_id, $id)
    {
        try {
            $studentCourse = StudentCourse::findOrFail($id);
            $studentCourse->delete();

            return redirect()->route('problems.problem.students', $this->problem->id)
                ->with('success_message', trans('student_courses.model_was_deleted'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('student_courses.unexpected_error')]);
        }
    }
}
