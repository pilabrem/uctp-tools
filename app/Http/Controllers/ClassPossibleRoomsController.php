<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassPossibleRoomsFormRequest;
use App\Models\ClassPossibleRoom;
use App\Models\Classe;
use App\Models\Room;
use Exception;
use Illuminate\Support\Facades\URL;

// Pilabrem
class ClassPossibleRoomsController extends Controller
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
     * Display a listing of the class possible rooms.
     *
     * @return \Illuminate\View\View
     */
    public function index($classe_id)
    {
        // $classPossibleRooms = ClassPossibleRoom::with('room', 'classe')->paginate(25);

        // return view('class_possible_rooms.index', compact('classPossibleRooms'));
        return redirect()->route('problems.problem.courses', $this->problem->id);
    }

    /**
     * Show the form for creating a new class possible room.
     *
     * @return \Illuminate\View\View
     */
    public function create($classe_id)
    {
        $rooms = Room::pluck('id_room', 'id')->all();
        $classes = Classe::pluck('name', 'id')->all();

        return view('class_possible_rooms.create', compact('rooms', 'classes'));
    }

    /**
     * Store a new class possible room in the storage.
     *
     * @param \App\Http\Requests\ClassPossibleRoomsFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store($classe_id, ClassPossibleRoomsFormRequest $request)
    {
        try {

            $data = $request->getData();

            ClassPossibleRoom::create($data);

            return redirect()->route('problems.problem.courses', $this->problem->id)
                ->with('success_message', trans('class_possible_rooms.model_was_added'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('class_possible_rooms.unexpected_error')]);
        }
    }

    /**
     * Display the specified class possible room.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($classe_id, $id)
    {
        $classPossibleRoom = ClassPossibleRoom::with('room', 'classe')->findOrFail($id);

        return view('class_possible_rooms.show', compact('classPossibleRoom'));
    }

    /**
     * Show the form for editing the specified class possible room.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($classe_id, $id)
    {
        $classPossibleRoom = ClassPossibleRoom::findOrFail($id);
        $rooms = Room::pluck('id_room', 'id')->all();
        $classes = Classe::pluck('name', 'id')->all();

        return view('class_possible_rooms.edit', compact('classPossibleRoom', 'rooms', 'classes'));
    }

    /**
     * Update the specified class possible room in the storage.
     *
     * @param int $id
     * @param \App\Http\Requests\ClassPossibleRoomsFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($classe_id, $id, ClassPossibleRoomsFormRequest $request)
    {
        try {

            $data = $request->getData();

            $classPossibleRoom = ClassPossibleRoom::findOrFail($id);
            $classPossibleRoom->update($data);

            return redirect()->route('problems.problem.courses', $this->problem->id)
                ->with('success_message', trans('class_possible_rooms.model_was_updated'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('class_possible_rooms.unexpected_error')]);
        }
    }

    /**
     * Remove the specified class possible room from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($classe_id, $id)
    {
        try {
            $classPossibleRoom = ClassPossibleRoom::findOrFail($id);
            $classPossibleRoom->delete();

            return redirect()->route('problems.problem.courses', $this->problem->id)
                ->with('success_message', trans('class_possible_rooms.model_was_deleted'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('class_possible_rooms.unexpected_error')]);
        }
    }
}
