@component('components.box-show')

    @slot('left')
        <h4 class="mt-5 mb-5">Problem instance</h4>
    @endslot

    @slot('right')
        <form method="POST" action="{!! route('problems.problem.destroy', $problem->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
            <div class="btn-group btn-group-sm" role="group">
                <a href="{{ route('problems.problem.index') }}" class="btn btn-primary"
                    title="{{ trans('problems.show_all') }}">
                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('problems.problem.create') }}" class="btn btn-success"
                    title="{{ trans('problems.create') }}">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>

                <a href="{{ route('problems.problem.edit', $problem->id) }}" class="btn btn-primary"
                    title="{{ trans('problems.edit') }}">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                </a>

                <button type="submit" class="btn btn-danger" title="{{ trans('problems.delete') }}"
                    onclick="return confirm(&quot;{{ trans('problems.confirm_delete') }}&quot;)">
                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                </button>
            </div>
        </form>
    @endslot

    <dl class="dl-horizontal">
        <dt>Nom d'instance</dt>
        <dd>{{ $problem->name }}</dd>
        <dt>{{ trans('problem_view_forms.begin_hour') }}</dt>
        <dd>{{ $problem->begin_hour }}h</dd>
        <dt>{{ trans('problem_view_forms.days') }}</dt>
        <dd>{{ $problem->week_days }}</dd>
        <dt>Dans un créneau horaire</dt>
        <dd>{{ $problem->minutes_per_slot }}mn</dd>
        <dt>Dans la journée</dt>
        <dd>{{ $problem->slots_per_day }} créneaux horaires</dd>
        <dt>Dans la semaine</dt>
        <dd>{{ $problem->nr_days }} jours</dd>
        <dt>Dans le semestre</dt>
        <dd>{{ $problem->nr_weeks }} semaines</dd>
        <dt>Optimisation</dt>
        <dd>Time : {{ $problem->time_optimization }}</dd>
        <dd>Room : {{ $problem->room_optimization }}</dd>
        <dd>Distribution : {{ $problem->distribution_optimization }}</dd>
        <dd>Student : {{ $problem->student_optimisation }}</dd>

        <dt>Classe du problem</dt>
        <dd>{{ $problem->problem_class }}</dd>
        <dt>Est aléatoire</dt>
        <dd>{{ $problem->is_random == 1 ? 'Oui' : 'Non' }}</dd>

    </dl>

    <div class="row">
        <div class="col-sm-12">
            <a href="{{ route('problems.problem.show', $problem->id) }}" class="btn btn-default"
                {{ Route::is('problems.problem.show') ? 'disabled' : '' }}>Overview</a>
            <a href="{{ route('problems.problem.rooms', $problem->id) }}" class="btn btn-default"
                {{ Route::is('problems.problem.rooms', $problem->id) ? 'disabled' : '' }}>Rooms</a>
            <a href="{{ route('problems.problem.courses', $problem->id) }}" class="btn btn-default"
                {{ Route::is('problems.problem.courses', $problem->id) ? 'disabled' : '' }}>Courses</a>
            <a href="{{ route('problems.problem.distributions', $problem->id) }}" class="btn btn-default"
                {{ Route::is('problems.problem.distributions', $problem->id) ? 'disabled' : '' }}>Distribution
                Constraintes</a>
            <a href="{{ route('problems.problem.students', $problem->id) }}" class="btn btn-default"
                {{ Route::is('problems.problem.students', $problem->id) ? 'disabled' : '' }}>Students</a>
            <a href="{{ route('problems.problem.xml', $problem->id) }}" class="btn btn-primary"
                {{ Route::is('problems.problem.xml', $problem->id) ? 'disabled' : '' }}>Download XML</a>

            @if ($problem->is_random == 1 and $problem->is_generated == 0)
                <a href="{{ route('problems.problem.generate_randomly', $problem->id) }}" class="btn btn-danger"
                    {{ Route::is('problems.problem.generate_randomly', $problem->id) ? 'disabled' : '' }}>
                    Generate randomly
                </a>
            @endif

        </div>
    </div>
@endcomponent
