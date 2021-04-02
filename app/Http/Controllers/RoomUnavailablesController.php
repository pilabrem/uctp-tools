<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoomUnavailablesFormRequest;
use App\Models\Room;
use App\Models\RoomUnavailable;
use Exception;
use Illuminate\Support\Facades\URL;

// Pilabrem
class RoomUnavailablesController extends Controller
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
     * Display a listing of the room unavailables.
     *
     * @return \Illuminate\View\View
     */
    public function index($room_id)
    {
        $roomUnavailables = RoomUnavailable::with('room')->paginate(25);

        // return view('room_unavailables.index', compact('roomUnavailables'));
        return redirect()->route('problems.problem.rooms', $this->problem->id);
    }

    /**
     * Show the form for creating a new room unavailable.
     *
     * @return \Illuminate\View\View
     */
    public function create($room_id)
    {
        $rooms = Room::pluck('id_room', 'id')->all();

        return view('room_unavailables.create', compact('rooms'));
    }

    /**
     * Store a new room unavailable in the storage.
     *
     * @param \App\Http\Requests\RoomUnavailablesFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store($room_id, RoomUnavailablesFormRequest $request)
    {
        try {

            $data = $request->getData();

            RoomUnavailable::create($data);

            return redirect()->route('problems.problem.rooms', $this->problem->id)
                ->with('success_message', trans('room_unavailables.model_was_added'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('room_unavailables.unexpected_error')]);
        }
    }

    /**
     * Display the specified room unavailable.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($room_id, $id)
    {
        $roomUnavailable = RoomUnavailable::with('room')->findOrFail($id);

        return view('room_unavailables.show', compact('roomUnavailable'));
    }

    /**
     * Show the form for editing the specified room unavailable.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($room_id, $id)
    {
        $roomUnavailable = RoomUnavailable::findOrFail($id);
        $rooms = Room::pluck('id_room', 'id')->all();

        return view('room_unavailables.edit', compact('roomUnavailable', 'rooms'));
    }

    /**
     * Update the specified room unavailable in the storage.
     *
     * @param int $id
     * @param \App\Http\Requests\RoomUnavailablesFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($room_id, $id, RoomUnavailablesFormRequest $request)
    {
        try {

            $data = $request->getData();

            $roomUnavailable = RoomUnavailable::findOrFail($id);
            $roomUnavailable->update($data);

            return redirect()->route('problems.problem.rooms', $this->problem->id)
                ->with('success_message', trans('room_unavailables.model_was_updated'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('room_unavailables.unexpected_error')]);
        }
    }

    /**
     * Remove the specified room unavailable from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($room_id, $id)
    {
        try {
            $roomUnavailable = RoomUnavailable::findOrFail($id);
            $roomUnavailable->delete();

            return redirect()->route('problems.problem.rooms', $this->problem->id)
                ->with('success_message', trans('room_unavailables.model_was_deleted'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('room_unavailables.unexpected_error')]);
        }
    }
}
