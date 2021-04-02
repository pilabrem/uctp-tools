<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassesFormRequest;
use App\Models\Classe;
use App\Models\Subpart;
use Exception;
use Illuminate\Support\Facades\URL;

// Pilabrem
class ClassesController extends Controller
{

    protected $problem = null;
    protected $subpart = null;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            $subpart = Subpart::findOrFail($request->subpart_id);
            $this->subpart = $subpart;
            $this->problem = optional(optional(optional($subpart)->config)->course)->problem;
            URL::defaults(['subpart_id' => $subpart->id]);
            view()->share('subpart', $subpart);
            view()->share('problem', $this->problem);

            return $next($request);
        });
    }

    /**
     * Display a listing of the classes.
     *
     * @return \Illuminate\View\View
     */
    public function index($subpart_id)
    {
        $classes = Classe::with('subpart', 'parent')->paginate(25);

        // return view('classes.index', compact('classes'));
        return redirect()->route('problems.problem.courses', $this->problem->id);
    }

    /**
     * Show the form for creating a new classe.
     *
     * @return \Illuminate\View\View
     */
    public function create($subpart_id)
    {
        $subparts = Subpart::pluck('name', 'id')->all();
        $parents = Classe::pluck('name', 'id')->all();

        return view('classes.create', compact('subparts', 'parents'));
    }

    /**
     * Store a new classe in the storage.
     *
     * @param \App\Http\Requests\ClassesFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store($subpart_id, ClassesFormRequest $request)
    {
        try {

            $data = $request->getData();

            Classe::create($data);

            return redirect()->route('problems.problem.courses', $this->problem->id)
                ->with('success_message', trans('classes.model_was_added'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('classes.unexpected_error')]);
        }
    }

    /**
     * Display the specified classe.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($subpart_id, $id)
    {
        $classe = Classe::with('subpart', 'parent')->findOrFail($id);

        return view('classes.show', compact('classe'));
    }

    /**
     * Show the form for editing the specified classe.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($subpart_id, $id)
    {
        $classe = Classe::findOrFail($id);
        $subparts = Subpart::pluck('name', 'id')->all();
        $parents = Classe::pluck('name', 'id')->all();

        return view('classes.edit', compact('classe', 'subparts', 'parents'));
    }

    /**
     * Update the specified classe in the storage.
     *
     * @param int $id
     * @param \App\Http\Requests\ClassesFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($subpart_id, $id, ClassesFormRequest $request)
    {
        try {

            $data = $request->getData();

            $classe = Classe::findOrFail($id);
            $classe->update($data);

            return redirect()->route('problems.problem.courses', $this->problem->id)
                ->with('success_message', trans('classes.model_was_updated'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('classes.unexpected_error')]);
        }
    }

    /**
     * Remove the specified classe from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($subpart_id, $id)
    {
        try {
            $classe = Classe::findOrFail($id);
            $classe->delete();

            return redirect()->route('problems.problem.courses', $this->problem->id)
                ->with('success_message', trans('classes.model_was_deleted'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('classes.unexpected_error')]);
        }
    }
}
