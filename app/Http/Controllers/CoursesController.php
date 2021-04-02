<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CoursesFormRequest;
use App\Models\Course;
use App\Models\Problem;
use Exception;
use Illuminate\Support\Facades\URL;

// Pilabrem
class CoursesController extends Controller
{


    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            $problem = Problem::findOrFail($request->problem_id);
            URL::defaults(['problem_id' => $problem->id]);
            view()->share('problem', $problem);

            return $next($request);
        });
    }

    /**
     * Display a listing of the courses.
     *
     * @return \Illuminate\View\View
     */
    public function index($problem_id)
    {
        $courses = Course::with('problem')->paginate(25);

        // return view('courses.index', compact('courses'));
        return redirect()->route('problems.problem.courses', $problem_id);
    }

    /**
     * Show the form for creating a new course.
     *
     * @return \Illuminate\View\View
     */
    public function create($problem_id)
    {
        $problems = Problem::pluck('name', 'id')->all();

        return view('courses.create', compact('problems'));
    }

    /**
     * Store a new course in the storage.
     *
     * @param \App\Http\Requests\CoursesFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store($problem_id, CoursesFormRequest $request)
    {
        try {

            $data = $request->getData();

            Course::create($data);

            return redirect()->route('problems.problem.courses', $problem_id)
                ->with('success_message', trans('courses.model_was_added'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('courses.unexpected_error')]);
        }
    }

    /**
     * Display the specified course.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($problem_id, $id)
    {
        $course = Course::with('problem')->findOrFail($id);

        return view('courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified course.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($problem_id, $id)
    {
        $course = Course::findOrFail($id);
        $problems = Problem::pluck('name', 'id')->all();

        return view('courses.edit', compact('course', 'problems'));
    }

    /**
     * Update the specified course in the storage.
     *
     * @param int $id
     * @param \App\Http\Requests\CoursesFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($problem_id, $id, CoursesFormRequest $request)
    {
        try {

            $data = $request->getData();

            $course = Course::findOrFail($id);
            $course->update($data);

            return redirect()->route('problems.problem.courses', $problem_id)
                ->with('success_message', trans('courses.model_was_updated'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('courses.unexpected_error')]);
        }
    }

    /**
     * Remove the specified course from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($problem_id, $id)
    {
        try {
            $course = Course::findOrFail($id);
            $course->delete();

            return redirect()->route('problems.problem.courses', $problem_id)
                ->with('success_message', trans('courses.model_was_deleted'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('courses.unexpected_error')]);
        }
    }
}
