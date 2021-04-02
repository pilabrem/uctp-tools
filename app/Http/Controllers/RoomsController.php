<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoomsFormRequest;
use App\Models\Problem;
use App\Models\Room;
use Exception;
use Illuminate\Support\Facades\URL;

// Pilabrem
class RoomsController extends Controller
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
     * Display a listing of the rooms.
     *
     * @return \Illuminate\View\View
     */
    public function index($problem_id)
    {
        $rooms = Room::with('problem')->paginate(25);

        // return view('rooms.index', compact('rooms'));
        return redirect()->route('problems.problem.rooms', $problem_id);
    }

    /**
     * Show the form for creating a new room.
     *
     * @return \Illuminate\View\View
     */
    public function create($problem_id)
    {
        $problems = Problem::pluck('name', 'id')->all();

        return view('rooms.create', compact('problems'));
    }

    /**
     * Store a new room in the storage.
     *
     * @param \App\Http\Requests\RoomsFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store($problem_id, RoomsFormRequest $request)
    {
        try {

            $data = $request->getData();

            Room::create($data);

            return redirect()->route('problems.problem.rooms', $problem_id)
                ->with('success_message', trans('rooms.model_was_added'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('rooms.unexpected_error')]);
        }
    }

    /**
     * Display the specified room.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($problem_id, $id)
    {
        $room = Room::with('problem')->findOrFail($id);

        return view('rooms.show', compact('room'));
    }

    /**
     * Show the form for editing the specified room.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($problem_id, $id)
    {
        $room = Room::findOrFail($id);
        $problems = Problem::pluck('name', 'id')->all();

        return view('rooms.edit', compact('room', 'problems'));
    }

    /**
     * Update the specified room in the storage.
     *
     * @param int $id
     * @param \App\Http\Requests\RoomsFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($problem_id, $id, RoomsFormRequest $request)
    {
        try {

            $data = $request->getData();

            $room = Room::findOrFail($id);
            $room->update($data);

            return redirect()->route('problems.problem.rooms', $problem_id)
                ->with('success_message', trans('rooms.model_was_updated'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('rooms.unexpected_error')]);
        }
    }

    /**
     * Remove the specified room from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($problem_id, $id)
    {
        try {
            $room = Room::findOrFail($id);
            $room->delete();

            return redirect()->route('problems.problem.rooms', $problem_id)
                ->with('success_message', trans('rooms.model_was_deleted'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('rooms.unexpected_error')]);
        }
    }
}
