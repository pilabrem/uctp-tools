<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassPossibleTimesFormRequest;
use App\Models\ClassPossibleTime;
use App\Models\Classe;
use Exception;
use Illuminate\Support\Facades\URL;

// Pilabrem
class ClassPossibleTimesController extends Controller
{

    protected $problem = null;
    protected $classe = null;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            $classe = Classe::findOrFail($request->classe_id);
            $this->classe = $classe;
            $this->problem = optional(optional(optional(optional($classe)->subpart)->config)->course)->problem;
            URL::defaults(['classe_id' => $classe->id]);
            view()->share('classe', $classe);
            view()->share('problem', $this->problem);

            return $next($request);
        });
    }

    /**
     * Display a listing of the class possible times.
     *
     * @return \Illuminate\View\View
     */
    public function index($classe_id)
    {
        // $classPossibleTimes = ClassPossibleTime::with('classe')->paginate(25);

        // return view('class_possible_times.index', compact('classPossibleTimes'));
        return redirect()->route('problems.problem.courses', $this->problem->id);
    }

    /**
     * Show the form for creating a new class possible time.
     *
     * @return \Illuminate\View\View
     */
    public function create($classe_id)
    {
        $classes = Classe::pluck('name', 'id')->all();

        return view('class_possible_times.create', compact('classes'));
    }

    /**
     * Store a new class possible time in the storage.
     *
     * @param \App\Http\Requests\ClassPossibleTimesFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store($classe_id, ClassPossibleTimesFormRequest $request)
    {
        try {

            $data = $request->getData();

            ClassPossibleTime::create($data);

            return redirect()->route('problems.problem.courses', $this->problem->id)
                ->with('success_message', trans('class_possible_times.model_was_added'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('class_possible_times.unexpected_error')]);
        }
    }

    /**
     * Display the specified class possible time.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($classe_id, $id)
    {
        $classPossibleTime = ClassPossibleTime::with('classe')->findOrFail($id);

        return view('class_possible_times.show', compact('classPossibleTime'));
    }

    /**
     * Show the form for editing the specified class possible time.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($classe_id, $id)
    {
        $classPossibleTime = ClassPossibleTime::findOrFail($id);
        $classes = Classe::pluck('name', 'id')->all();

        return view('class_possible_times.edit', compact('classPossibleTime', 'classes'));
    }

    /**
     * Update the specified class possible time in the storage.
     *
     * @param int $id
     * @param \App\Http\Requests\ClassPossibleTimesFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($classe_id, $id, ClassPossibleTimesFormRequest $request)
    {
        try {

            $data = $request->getData();

            $classPossibleTime = ClassPossibleTime::findOrFail($id);
            $classPossibleTime->update($data);

            return redirect()->route('problems.problem.courses', $this->problem->id)
                ->with('success_message', trans('class_possible_times.model_was_updated'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('class_possible_times.unexpected_error')]);
        }
    }

    /**
     * Remove the specified class possible time from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($classe_id, $id)
    {
        try {
            $classPossibleTime = ClassPossibleTime::findOrFail($id);
            $classPossibleTime->delete();

            return redirect()->route('problems.problem.courses', $this->problem->id)
                ->with('success_message', trans('class_possible_times.model_was_deleted'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('class_possible_times.unexpected_error')]);
        }
    }
}
