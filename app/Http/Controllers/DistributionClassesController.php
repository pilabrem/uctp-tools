<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\DistributionClassesFormRequest;
use App\Models\Classe;
use App\Models\Distribution;
use App\Models\DistributionClass;
use Exception;
use Illuminate\Support\Facades\URL;

// Pilabrem
class DistributionClassesController extends Controller
{

    protected $problem = null;
    protected $distribution = null;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            $distribution = Distribution::findOrFail($request->distribution_id);
            $this->distribution = $distribution;
            $this->problem = $distribution->problem;
            URL::defaults(['distribution_id' => $distribution->id]);
            view()->share('distribution', $distribution);
            view()->share('problem', $this->problem);

            return $next($request);
        });
    }

    /**
     * Display a listing of the distribution classes.
     *
     * @return \Illuminate\View\View
     */
    public function index($problem_id)
    {
        return redirect()->route('problems.problem.distributions', $this->problem->id);
    }

    /**
     * Show the form for creating a new distribution class.
     *
     * @return \Illuminate\View\View
     */
    public function create($problem_id)
    {
        $classes = Classe::pluck('name', 'id')->all();
        $distributions = Distribution::pluck('type', 'id')->all();

        return view('distribution_classes.create', compact('classes', 'distributions'));
    }

    /**
     * Store a new distribution class in the storage.
     *
     * @param \App\Http\Requests\DistributionClassesFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store($problem_id, DistributionClassesFormRequest $request)
    {
        try {

            $data = $request->getData();

            DistributionClass::create($data);

            return redirect()->route('problems.problem.distributions', $this->problem->id)
                ->with('success_message', trans('distribution_classes.model_was_added'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('distribution_classes.unexpected_error')]);
        }
    }

    /**
     * Display the specified distribution class.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($problem_id, $id)
    {
        $distributionClass = DistributionClass::with('classe', 'distribution')->findOrFail($id);

        return view('distribution_classes.show', compact('distributionClass'));
    }

    /**
     * Show the form for editing the specified distribution class.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($problem_id, $id)
    {
        $distributionClass = DistributionClass::findOrFail($id);
        $classes = Classe::pluck('name', 'id')->all();
        $distributions = Distribution::pluck('type', 'id')->all();

        return view('distribution_classes.edit', compact('distributionClass', 'classes', 'distributions'));
    }

    /**
     * Update the specified distribution class in the storage.
     *
     * @param int $id
     * @param \App\Http\Requests\DistributionClassesFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($problem_id, $id, DistributionClassesFormRequest $request)
    {
        try {

            $data = $request->getData();

            $distributionClass = DistributionClass::findOrFail($id);
            $distributionClass->update($data);

            return redirect()->route('problems.problem.distributions', $this->problem->id)
                ->with('success_message', trans('distribution_classes.model_was_updated'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('distribution_classes.unexpected_error')]);
        }
    }

    /**
     * Remove the specified distribution class from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($problem_id, $id)
    {
        try {
            $distributionClass = DistributionClass::findOrFail($id);
            $distributionClass->delete();

            return redirect()->route('problems.problem.distributions', $this->problem->id)
                ->with('success_message', trans('distribution_classes.model_was_deleted'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('distribution_classes.unexpected_error')]);
        }
    }
}
