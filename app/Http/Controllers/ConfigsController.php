<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConfigsFormRequest;
use App\Models\Config;
use App\Models\Course;
use Exception;
use Illuminate\Support\Facades\URL;

// Pilabrem
class ConfigsController extends Controller
{

    protected $problem = null;
    protected $course = null;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            $course = Course::findOrFail($request->course_id);
            $this->course = $course;
            $this->problem = $course->problem;
            URL::defaults(['course_id' => $course->id]);
            view()->share('course', $course);
            view()->share('problem', $this->problem);

            return $next($request);
        });
    }

    /**
     * Display a listing of the configs.
     *
     * @return \Illuminate\View\View
     */
    public function index($course_id)
    {
        $configs = Config::with('course')->paginate(25);

        // return view('configs.index', compact('configs'));
        return redirect()->route('problems.problem.courses', $this->problem->id);
    }

    /**
     * Show the form for creating a new config.
     *
     * @return \Illuminate\View\View
     */
    public function create($course_id)
    {
        $courses = Course::pluck('name', 'id')->all();

        return view('configs.create', compact('courses'));
    }

    /**
     * Store a new config in the storage.
     *
     * @param \App\Http\Requests\ConfigsFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store($course_id, ConfigsFormRequest $request)
    {
        try {

            $data = $request->getData();

            Config::create($data);

            return redirect()->route('problems.problem.courses', $this->problem->id)
                ->with('success_message', trans('configs.model_was_added'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('configs.unexpected_error')]);
        }
    }

    /**
     * Display the specified config.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($course_id, $id)
    {
        $config = Config::with('course')->findOrFail($id);

        return view('configs.show', compact('config'));
    }

    /**
     * Show the form for editing the specified config.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($course_id, $id)
    {
        $config = Config::findOrFail($id);
        $courses = Course::pluck('name', 'id')->all();

        return view('configs.edit', compact('config', 'courses'));
    }

    /**
     * Update the specified config in the storage.
     *
     * @param int $id
     * @param \App\Http\Requests\ConfigsFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($course_id, $id, ConfigsFormRequest $request)
    {
        try {

            $data = $request->getData();

            $config = Config::findOrFail($id);
            $config->update($data);

            return redirect()->route('problems.problem.courses', $this->problem->id)
                ->with('success_message', trans('configs.model_was_updated'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('configs.unexpected_error')]);
        }
    }

    /**
     * Remove the specified config from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($course_id, $id)
    {
        try {
            $config = Config::findOrFail($id);
            $config->delete();

            return redirect()->route('problems.problem.courses', $this->problem->id)
                ->with('success_message', trans('configs.model_was_deleted'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('configs.unexpected_error')]);
        }
    }
}
