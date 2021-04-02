<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TravelFormRequest;
use App\Models\Room;
use App\Models\Travel;
use Exception;
use Illuminate\Support\Facades\URL;

// Pilabrem
class TravelController extends Controller
{

    protected $problem = null;
    protected $room = null;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            $room = Room::findOrFail($request->room_id);
            $this->room = $room;
            $this->problem = $room->problem;
            URL::defaults(['room_id' => $room->id]);
            view()->share('room', $room);
            view()->share('problem', $this->problem);

            return $next($request);
        });
    }


    /**
     * Display a listing of the travel.
     *
     * @return \Illuminate\View\View
     */
    public function index($room_id)
    {
        $travelObjects = Travel::with('room')->paginate(25);

        // return view('travel.index', compact('travelObjects'));
        return redirect()->route('problems.problem.rooms', $this->problem->id);
    }

    /**
     * Show the form for creating a new travel.
     *
     * @return \Illuminate\View\View
     */
    public function create($room_id)
    {
        $rooms = Room::pluck('id_room', 'id')->all();

        return view('travel.create', compact('rooms'));
    }

    /**
     * Store a new travel in the storage.
     *
     * @param \App\Http\Requests\TravelFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store($room_id, TravelFormRequest $request)
    {
        try {

            $data = $request->getData();

            Travel::create($data);

            return redirect()->route('problems.problem.rooms', $this->problem->id)
                ->with('success_message', trans('travel.model_was_added'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('travel.unexpected_error')]);
        }
    }

    /**
     * Display the specified travel.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($room_id, $id)
    {
        $travel = Travel::with('room')->findOrFail($id);

        return view('travel.show', compact('travel'));
    }

    /**
     * Show the form for editing the specified travel.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($room_id, $id)
    {
        $travel = Travel::findOrFail($id);
        $rooms = Room::pluck('id_room', 'id')->all();

        return view('travel.edit', compact('travel', 'rooms'));
    }

    /**
     * Update the specified travel in the storage.
     *
     * @param int $id
     * @param \App\Http\Requests\TravelFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($room_id, $id, TravelFormRequest $request)
    {
        try {

            $data = $request->getData();

            $travel = Travel::findOrFail($id);
            $travel->update($data);

            return redirect()->route('problems.problem.rooms', $this->problem->id)
                ->with('success_message', trans('travel.model_was_updated'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('travel.unexpected_error')]);
        }
    }

    /**
     * Remove the specified travel from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($room_id, $id)
    {
        try {
            $travel = Travel::findOrFail($id);
            $travel->delete();

            return redirect()->route('problems.problem.rooms', $this->problem->id)
                ->with('success_message', trans('travel.model_was_deleted'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('travel.unexpected_error')]);
        }
    }
}
