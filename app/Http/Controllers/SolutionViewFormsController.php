<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SolutionViewFormsFormRequest;
use App\Models\SolutionViewForm;
use Exception;
use SimpleXMLElement;

// Pilabrem
class SolutionViewFormsController extends Controller
{

    /**
     * Display a listing of the solution view forms.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $solutionViewForms = SolutionViewForm::paginate(10);

        return view('solution_view_forms.index', compact('solutionViewForms'));
    }

    /**
     * Show the form for creating a new solution view form.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {


        return view('solution_view_forms.create');
    }

    /**
     * Store a new solution view form in the storage.
     *
     * @param \App\Http\Requests\SolutionViewFormsFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(SolutionViewFormsFormRequest $request)
    {
        try {

            $data = $request->getData();

            SolutionViewForm::create($data);

            return redirect()->route('solution_view_forms.solution_view_form.index')
                ->with('success_message', trans('solution_view_forms.model_was_added'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('solution_view_forms.unexpected_error')]);
        }
    }

    /**
     * Display the specified solution view form.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $solutionViewForm = SolutionViewForm::findOrFail($id);

        $solutionInstanceFile = public_path("storage\\" . $solutionViewForm->solution_instance);
        $xml = new SimpleXMLElement($solutionInstanceFile, null, true);

        //
        $solutionInstance = $xml;

        // Get students list
        $students = array();
        foreach ($solutionInstance->class as $classe) {
            foreach ($classe->student as $student) {
                $st = (string) $student['id'];
                if (!in_array($st, $students)) {
                    $students[] = $st;
                }
            }
        }

        // Get selected student
        $selectedStudent = null;
        if (request()->student !== null and request()->student !== 0 and in_array(request()->student, $students)) {
            $selectedStudent = request()->student;
        } else if (count($students) > 0) {
            $selectedStudent = $students[0];
        }

        // Get selected student classes
        $classes = array();
        foreach ($solutionInstance->class as $classe) {
            foreach ($classe->student as $student) {
                $st = (string) $student['id'];
                if ($selectedStudent == $st) {
                    $classes[] = [
                        "id" => (string) $classe['id'],
                        "days" => (string) $classe['days'],
                        "start" => (int) $classe['start'],
                        "weeks" => (string) $classe['weeks'],
                        "room" => (string) $classe['room'],
                    ];
                }
            }
        }

        // Calculer le nombre de jours dans une semaine
        $daysArray = explode(',', $solutionViewForm->week_days);
        $nbDays = count($daysArray);

        // Order student classes by week
        $classesByWeek = array();
        for ($i = 0; $i < $solutionViewForm->semester_weeks; $i++) {
            // week N° $i : les cours de la semaine
            $weeksI = array();
            foreach ($classes as $_classe) {
                if ($_classe['weeks'][$i] == '1') {
                    $_classe['week'] = $i;
                    $weeksI[] = $_classe;
                }
            }
            // Organiser les cours de la semaine par jour et par ordre
            $weekIDays = array();
            for ($j = 0; $j < $nbDays; $j++) {
                $dayClasses = array();
                foreach ($weeksI as $_weekIDay) {
                    if ($_weekIDay['days'][$j] == '1') {
                        $_weekIDay['day'] = $j;
                        $slotsPerHour = intdiv(60, $solutionViewForm->time_slot);
                        $_weekIDay['start_hour'] = $solutionViewForm->day_begin + \intdiv($_weekIDay['start'], $slotsPerHour);
                        $_weekIDay['start_hour'] .= 'h';
                        $reste = $_weekIDay['start'] % $slotsPerHour;
                        if ($reste > 0) {
                            $_weekIDay['start_hour'] .= $reste;
                        }
                        $dayClasses[] = $_weekIDay;
                    }
                }
                // Sort day classes by start
                usort($dayClasses, function ($a, $b) {
                    return $a['start'] <=> $b['start'];
                });

                $weekIDays[] = $dayClasses;
            }

            $classesByWeek[] = $weekIDays;
        }

        // Flash old inputs to view
        session()->flashInput(['student' => $selectedStudent]);

        return view('solution_view_forms.show', compact('solutionViewForm', 'solutionInstance', 'students', 'classesByWeek', 'daysArray'));
    }

    /**
     * Show the form for editing the specified solution view form.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $solutionViewForm = SolutionViewForm::findOrFail($id);


        return view('solution_view_forms.edit', compact('solutionViewForm'));
    }

    /**
     * Update the specified solution view form in the storage.
     *
     * @param int $id
     * @param \App\Http\Requests\SolutionViewFormsFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($id, SolutionViewFormsFormRequest $request)
    {
        try {

            $data = $request->getData();

            $solutionViewForm = SolutionViewForm::findOrFail($id);
            $solutionViewForm->update($data);

            return redirect()->route('solution_view_forms.solution_view_form.index')
                ->with('success_message', trans('solution_view_forms.model_was_updated'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('solution_view_forms.unexpected_error')]);
        }
    }

    /**
     * Remove the specified solution view form from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $solutionViewForm = SolutionViewForm::findOrFail($id);
            $solutionViewForm->delete();

            return redirect()->route('solution_view_forms.solution_view_form.index')
                ->with('success_message', trans('solution_view_forms.model_was_deleted'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('solution_view_forms.unexpected_error')]);
        }
    }
}
