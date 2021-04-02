<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\DistributionsFormRequest;
use App\Models\Distribution;
use App\Models\Problem;
use Exception;
use Illuminate\Support\Facades\URL;

// Pilabrem
class DistributionsController extends Controller
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
     * Display a listing of the distributions.
     *
     * @return \Illuminate\View\View
     */
    public function index($problem_id)
    {
        return redirect()->route('problems.problem.distributions', $problem_id);
    }

    /**
     * Show the form for creating a new distribution.
     *
     * @return \Illuminate\View\View
     */
    public function create($problem_id)
    {
        $problems = Problem::pluck('name', 'id')->all();

        return view('distributions.create', compact('problems'));
    }

    /**
     * Store a new distribution in the storage.
     *
     * @param \App\Http\Requests\DistributionsFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store($problem_id, DistributionsFormRequest $request)
    {
        try {

            $data = $request->getData();

            Distribution::create($data);

            return redirect()->route('problems.problem.distributions', $problem_id)
                ->with('success_message', trans('distributions.model_was_added'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('distributions.unexpected_error')]);
        }
    }

    /**
     * Display the specified distribution.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($problem_id, $id)
    {
        $distribution = Distribution::with('problem')->findOrFail($id);

        return view('distributions.show', compact('distribution'));
    }

    /**
     * Show the form for editing the specified distribution.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($problem_id, $id)
    {
        $distribution = Distribution::findOrFail($id);
        $problems = Problem::pluck('name', 'id')->all();

        return view('distributions.edit', compact('distribution', 'problems'));
    }

    /**
     * Update the specified distribution in the storage.
     *
     * @param int $id
     * @param \App\Http\Requests\DistributionsFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($problem_id, $id, DistributionsFormRequest $request)
    {
        try {

            $data = $request->getData();

            $distribution = Distribution::findOrFail($id);
            $distribution->update($data);

            return redirect()->route('problems.problem.distributions', $problem_id)
                ->with('success_message', trans('distributions.model_was_updated'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('distributions.unexpected_error')]);
        }
    }

    /**
     * Remove the specified distribution from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($problem_id, $id)
    {
        try {
            $distribution = Distribution::findOrFail($id);
            $distribution->delete();

            return redirect()->route('problems.problem.distributions', $problem_id)
                ->with('success_message', trans('distributions.model_was_deleted'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('distributions.unexpected_error')]);
        }
    }
}
