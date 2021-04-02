<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProblemsFormRequest;
use App\Models\Classe;
use App\Models\ClassPossibleRoom;
use App\Models\Config;
use App\Models\Course;
use App\Models\Problem;
use App\Models\Room;
use App\Models\Student;
use App\Models\StudentCourse;
use App\Models\Subpart;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Spatie\ArrayToXml\ArrayToXml;

// Pilabrem
class ProblemsController extends Controller
{

    /**
     * Display a listing of the problems.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $problems = Problem::paginate(25);

        return view('problems.index', compact('problems'));
    }

    /**
     * Show the form for creating a new problem.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {


        return view('problems.create');
    }

    /**
     * Store a new problem in the storage.
     *
     * @param \App\Http\Requests\ProblemsFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(ProblemsFormRequest $request)
    {
        try {

            $data = $request->getData();

            Problem::create($data);

            return redirect()->route('problems.problem.index')
                ->with('success_message', trans('problems.model_was_added'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('problems.unexpected_error')]);
        }
    }

    /**
     * Display the specified problem.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $problem = Problem::findOrFail($id);

        return view('problems.show', compact('problem'));
    }

    /**
     * Show the form for editing the specified problem.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $problem = Problem::findOrFail($id);


        return view('problems.edit', compact('problem'));
    }

    /**
     * Update the specified problem in the storage.
     *
     * @param int $id
     * @param \App\Http\Requests\ProblemsFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($id, ProblemsFormRequest $request)
    {
        try {

            $data = $request->getData();

            $problem = Problem::findOrFail($id);
            $problem->update($data);

            return redirect()->route('problems.problem.index')
                ->with('success_message', trans('problems.model_was_updated'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('problems.unexpected_error')]);
        }
    }

    /**
     * Remove the specified problem from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $problem = Problem::findOrFail($id);
            $problem->delete();

            return redirect()->route('problems.problem.index')
                ->with('success_message', trans('problems.model_was_deleted'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('problems.unexpected_error')]);
        }
    }



    // Rooms
    public function rooms($id)
    {
        $problem = Problem::with('rooms')->findOrFail($id);

        URL::defaults(['problem_id' => $problem->id]);

        return view('problems.sub.rooms', compact('problem'));
    }

    // Courses
    public function courses($id)
    {
        $problem = Problem::with('courses')->findOrFail($id);

        URL::defaults(['problem_id' => $problem->id]);

        return view('problems.sub.courses', compact('problem'));
    }

    // distributions
    public function distributions($id)
    {
        $problem = Problem::with('distributions')->findOrFail($id);

        URL::defaults(['problem_id' => $problem->id]);

        return view('problems.sub.distributions', compact('problem'));
    }

    // students
    public function students($id)
    {
        $problem = Problem::with('students')->findOrFail($id);

        URL::defaults(['problem_id' => $problem->id]);

        return view('problems.sub.students', compact('problem'));
    }

    // Download XML
    public function xml($id)
    {
        $problem = Problem::with('students')->findOrFail($id);
        $optimization = [
            'optimization' => [
                '_attributes' => [
                    'time' => $problem->time_optimization,
                    'room' => $problem->room_optimization,
                    'distribution' => $problem->distribution_optimization,
                    'student' => $problem->student_optimisation
                ]
            ]
        ];

        //
        //      Rooms
        //

        $rooms = [];

        foreach ($problem->rooms as $_room) {
            // Travel
            $travels = [];
            if ($_room->travels->count() > 0) {
                foreach ($_room->travels as $_travel) {
                    $travels[] = [
                        '_attributes' => [
                            'room' => optional($_travel->travelTo)->id_room,
                            'value' => $_travel->value
                        ]
                    ];
                }

                $travels = ['travel' => $travels];
            }

            // Unavailables times
            $unavailables = [];
            if ($_room->unavailabilities->count() > 0) {
                foreach ($_room->unavailabilities as $_unavailable) {
                    $unavailables[] = [
                        '_attributes' => [
                            'days' => $problem->getDaysBinary($_unavailable->days),
                            'start' => $_unavailable->start,
                            'length' => $_unavailable->length,
                            'weeks' => $problem->getWeeksBinary($_unavailable->weeks),
                        ]
                    ];
                }

                $unavailables = ['unavailable' => $unavailables];
            }

            // Room
            $rooms[] = array_merge(
                [
                    '_attributes' => [
                        'id' => $_room->id_room,
                        'capacity' => $_room->capacity
                    ]
                ],
                $travels,
                $unavailables
            );
        }

        $rooms = ['rooms' => ['room' => $rooms]];






        //
        //      Courses
        //
        $courses = [];

        foreach ($problem->courses as $_course) {
            //////////////////
            // Configs
            $configs = [];
            if ($_course->configs->count() > 0) {
                foreach ($_course->configs as $_config) {
                    ////////////////////
                    // Subparts
                    $subparts = [];
                    if ($_config->subparts->count() > 0) {
                        foreach ($_config->subparts as $_subpart) {

                            /////////////////////////
                            // classes
                            $classes = [];
                            if ($_subpart->classes->count() > 0) {
                                foreach ($_subpart->classes as $_classe) {


                                    ///////////////////////////
                                    // class_possible_time
                                    $class_possible_times = [];
                                    if ($_classe->possibleTimes->count() > 0) {
                                        foreach ($_classe->possibleTimes as $_class_possible_time) {


                                            // class_possible_time
                                            $class_possible_times[] = [
                                                '_attributes' => [
                                                    'days' => $problem->getDaysBinary($_class_possible_time->days),
                                                    'start' => $_class_possible_time->start,
                                                    'length' => $_class_possible_time->length,
                                                    'weeks' => $problem->getWeeksBinary($_class_possible_time->weeks),
                                                    'penalty' => $_class_possible_time->penalty
                                                ]
                                            ];
                                        }

                                        $class_possible_times = ['time' => $class_possible_times];
                                    }


                                    ////////////////////////////////
                                    // class_possible_rooms
                                    $class_possible_rooms = [];
                                    if ($_classe->possibleRooms->count() > 0) {
                                        foreach ($_classe->possibleRooms as $_class_possible_room) {


                                            // class_possible_room
                                            $class_possible_rooms[] = [
                                                '_attributes' => [
                                                    'id' => optional($_class_possible_room->room)->id_room,
                                                    'penalty' => $_class_possible_room->penalty
                                                ]
                                            ];
                                        }

                                        $class_possible_rooms = ['room' => $class_possible_rooms];
                                    }


                                    // classe
                                    $classes[] = array_merge([
                                        '_attributes' => [
                                            'id' => $_classe->name,
                                            'limit' => $_classe->limit
                                        ]
                                    ], $class_possible_rooms, $class_possible_times);
                                }

                                $classes = ['class' => $classes];
                            }


                            // subpart
                            $subparts[] = array_merge([
                                '_attributes' => [
                                    'id' => $_subpart->name
                                ]
                            ], $classes);
                        }

                        $subparts = ['subpart' => $subparts];
                    }


                    // Config
                    $configs[] = array_merge(
                        [
                            '_attributes' => [
                                'id' => $_config->name
                            ]
                        ],
                        $subparts
                    );
                }

                $configs = ['config' => $configs];
            }

            // Course
            $courses[] = array_merge(
                [
                    '_attributes' => [
                        'id' => $_course->name
                    ]
                ],
                $configs
            );
        }

        $courses = ['courses' => ['course' => $courses]];













        //
        //      distributions
        //

        $distributions = [];

        foreach ($problem->distributions as $_distribution) {
            // Distribution Class
            $distribution_classes = [];
            if ($_distribution->classes->count() > 0) {
                foreach ($_distribution->classes as $_dclasse) {
                    $distribution_classes[] = [
                        '_attributes' => [
                            'id' => optional($_dclasse->classe)->name
                        ]
                    ];
                }

                $distribution_classes = ['class' => $distribution_classes];
            }


            // Distribution ATTR
            $dtype = $_distribution->type;
            if (isset($_distribution->param1)) {
                $dtype .= '(' . $_distribution->param1;
                if (isset($_distribution->param2)) {
                    $dtype .= ',' . $_distribution->param2;
                }
                $dtype .= ')';
            }
            $d_attr = [
                'type' => $dtype
            ];

            // distribution is required ?
            if ($_distribution->is_required == 1) {
                $d_attr = array_merge($d_attr, ['required' => 'true']);
            }

            // distribution has penalty ?
            if (isset($_distribution->penalty)) {
                $d_attr = array_merge($d_attr, ['penalty' => $_distribution->penalty]);
            }

            // distribution
            $distributions[] = array_merge(
                [
                    '_attributes' => $d_attr
                ],
                $distribution_classes
            );
        }

        $distributions = ['distributions' => ['distribution' => $distributions]];









        //
        //      students
        //
        $students = [];

        foreach ($problem->students as $_student) {
            // student_course
            $student_courses = [];
            if ($_student->courses->count() > 0) {
                foreach ($_student->courses as $_student_course) {
                    $student_courses[] = [
                        '_attributes' => [
                            'id' => optional($_student_course->course)->name
                        ]
                    ];
                }

                $student_courses = ['course' => $student_courses];
            }

            // student
            $students[] = array_merge(
                [
                    '_attributes' => [
                        'id' => $_student->name
                    ]
                ],
                $student_courses
            );
        }


        $students = ['students' => ['student' => $students]];








        ///////////////////
        // Last Part
        $array = [];

        $array = array_merge($array, $optimization, $rooms, $courses, $distributions, $students);

        $result = ArrayToXml::convert(
            $array,
            [
                'rootElementName' => 'problem',
                '_attributes' => [
                    'name' => $problem->name,
                    'nrDays' => $problem->nr_days,
                    'nrWeeks' => $problem->nr_weeks,
                    'slotsPerDay' => $problem->slots_per_day,
                ],
            ],
            true,
            'UTF-8'
        );


        $response = response($result, 200);
        $response->header('Content-Type', 'text/xml');
        $response->header('Cache-Control', 'public');
        $response->header('Content-Description', 'File Transfer');
        $response->header('Content-Disposition', 'attachment; filename=' . \Str::snake($problem->name) . '.xml');
        $response->header('Content-Transfer-Encoding', 'binary');
        return $response;
    }






    // generateRandomly
    public function generateRandomly($id)
    {
        try {

            DB::beginTransaction();

            $problem = Problem::with('students')->findOrFail($id);

            // Remove existing
            $problem->rooms()->delete();
            $problem->courses()->delete();
            $problem->students()->delete();
            $problem->distributions()->delete();

            // Les différentes tailles selon le benchmark de socha
            $tailles = [
                'small' => [
                    'nbcours' => 100,
                    'nbsalles' => 5,
                    'nbetudiants' => 80,
                    'maxcours_par_etudiant' => 20,
                    'maxetudiants_par_cours' => 20
                ],
                'medium' => [
                    'nbcours' => 400,
                    'nbsalles' => 10,
                    'nbetudiants' => 200,
                    'maxcours_par_etudiant' => 20,
                    'maxetudiants_par_cours' => 50
                ],
                'large' => [
                    'nbcours' => 400,
                    'nbsalles' => 10,
                    'nbetudiants' => 400,
                    'maxcours_par_etudiant' => 20,
                    'maxetudiants_par_cours' => 100
                ],
            ];



            $nbcours = $tailles[$problem->problem_class]['nbcours'];
            $nbsalles = $tailles[$problem->problem_class]['nbsalles'];
            $nbetudiants = $tailles[$problem->problem_class]['nbetudiants'];
            $maxcours_par_etudiant = $tailles[$problem->problem_class]['maxcours_par_etudiant'];
            $maxetudiants_par_cours = $tailles[$problem->problem_class]['maxetudiants_par_cours'];



            // Les salles  - Sans trajets et indiponibilités
            for ($i = 1; $i <= $nbsalles; $i++) {
                Room::create([
                    'problem_id' => $problem->id,
                    'id_room' => $i,
                    'capacity' => random_int(intdiv($maxetudiants_par_cours, 2), $maxetudiants_par_cours),
                ]);
            }



            // Courses sans
            for ($j = 1; $j <= $nbcours; $j++) {
                $course = Course::create(['name' => $j, 'problem_id' => $problem->id]);
                $config = Config::create(['name' => $j, 'course_id' => $course->id]);
                $subpart = Subpart::create(['name' => $j, 'config_id' => $config->id]);
                $classe = Classe::create([
                    'name' => $j,
                    'subpart_id' => $subpart->id,
                    'limit' => random_int(intdiv($maxetudiants_par_cours, 2), $maxetudiants_par_cours)
                ]);

                // Salles possibles du cours
                $nb_salles_possibles = random_int(1, $nbsalles);
                $sallesPossibles = Room::inRandomOrder()->whereProblemId($problem->id)->limit($nb_salles_possibles)->get();

                foreach ($sallesPossibles as $_salleP) {
                    ClassPossibleRoom::create([
                        'room_id' => $_salleP->id,
                        'penalty' => random_int(1, 10),
                        'classe_id' => $classe->id
                    ]);
                }


                //  Compléter les périodes possibles
            }



            // Etudiants
            for ($k = 1; $k < $nbetudiants; $k++) {
                $etudiant = Student::create([
                    'problem_id' => $problem->id,
                    'name' => $k
                ]);

                $nbCoursEtudiant = random_int(1, $maxcours_par_etudiant);
                $coursEtudiant = Course::inRandomOrder()->whereProblemId($problem->id)->limit($nbCoursEtudiant)->get();

                foreach ($coursEtudiant as $courEtudiant) {
                    StudentCourse::create([
                        'student_id' => $etudiant->id,
                        'course_id' => $courEtudiant->id
                    ]);
                }
            }



            DB::commit();

            return back()->withSuccessMessage("Problem generated");
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->withErrorMessage("An Error occured");
        }
    }
}
