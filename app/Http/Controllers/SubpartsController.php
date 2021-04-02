<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubpartsFormRequest;
use App\Models\Config;
use App\Models\Subpart;
use Exception;
use Illuminate\Support\Facades\URL;

// Pilabrem
class SubpartsController extends Controller
{

    protected $problem = null;
    protected $config = null;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            $config = Config::findOrFail($request->config_id);
            $this->config = $config;
            $this->problem = optional(optional($config)->course)->problem;
            URL::defaults(['config_id' => $config->id]);
            view()->share('config', $config);
            view()->share('problem', $this->problem);

            return $next($request);
        });
    }

    /**
     * Display a listing of the subparts.
     *
     * @return \Illuminate\View\View
     */
    public function index($config_id)
    {
        $subparts = Subpart::with('config')->paginate(25);

        // return view('subparts.index', compact('subparts'));
        return redirect()->route('problems.problem.courses', $this->problem->id);
    }

    /**
     * Show the form for creating a new subpart.
     *
     * @return \Illuminate\View\View
     */
    public function create($config_id)
    {
        $configs = Config::pluck('name', 'id')->all();

        return view('subparts.create', compact('configs'));
    }

    /**
     * Store a new subpart in the storage.
     *
     * @param \App\Http\Requests\SubpartsFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store($config_id, SubpartsFormRequest $request)
    {
        try {

            $data = $request->getData();

            Subpart::create($data);

            return redirect()->route('problems.problem.courses', $this->problem->id)
                ->with('success_message', trans('subparts.model_was_added'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('subparts.unexpected_error')]);
        }
    }

    /**
     * Display the specified subpart.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($config_id, $id)
    {
        $subpart = Subpart::with('config')->findOrFail($id);

        return view('subparts.show', compact('subpart'));
    }

    /**
     * Show the form for editing the specified subpart.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($config_id, $id)
    {
        $subpart = Subpart::findOrFail($id);
        $configs = Config::pluck('name', 'id')->all();

        return view('subparts.edit', compact('subpart', 'configs'));
    }

    /**
     * Update the specified subpart in the storage.
     *
     * @param int $id
     * @param \App\Http\Requests\SubpartsFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($config_id, $id, SubpartsFormRequest $request)
    {
        try {

            $data = $request->getData();

            $subpart = Subpart::findOrFail($id);
            $subpart->update($data);

            return redirect()->route('problems.problem.courses', $this->problem->id)
                ->with('success_message', trans('subparts.model_was_updated'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('subparts.unexpected_error')]);
        }
    }

    /**
     * Remove the specified subpart from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($config_id, $id)
    {
        try {
            $subpart = Subpart::findOrFail($id);
            $subpart->delete();

            return redirect()->route('problems.problem.courses', $this->problem->id)
                ->with('success_message', trans('subparts.model_was_deleted'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('subparts.unexpected_error')]);
        }
    }
}
