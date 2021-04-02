@component('components.box-show')

    @slot('left')
        <h4 class="mt-5 mb-5">{{ !empty($title) ? $title : 'Problem instance' }}</h4>
    @endslot

    @slot('right')
        <form method="POST" action="{!!  route('problem_view_forms.problem_view_form.destroy', $problemViewForm->id) !!}"
            accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
            <div class="btn-group btn-group-sm" role="group">
                <a href="{{ route('problem_view_forms.problem_view_form.index') }}" class="btn btn-primary"
                    title="{{ trans('problem_view_forms.show_all') }}">
                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('problem_view_forms.problem_view_form.create') }}" class="btn btn-success"
                    title="{{ trans('problem_view_forms.create') }}">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>

                <a href="{{ route('problem_view_forms.problem_view_form.edit', $problemViewForm->id) }}"
                    class="btn btn-primary" title="{{ trans('problem_view_forms.edit') }}">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                </a>

                <button type="submit" class="btn btn-danger" title="{{ trans('problem_view_forms.delete') }}"
                    onclick="return confirm(&quot;{{ trans('problem_view_forms.confirm_delete') }}&quot;)">
                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                </button>
            </div>
        </form>
    @endslot

    <dl class="dl-horizontal">
        <dt>Nom d'instance</dt>
        <dd>{{ $problemInstance['name'] }}</dd>
        <dt>{{ trans('problem_view_forms.begin_hour') }}</dt>
        <dd>{{ $problemViewForm->begin_hour }}h</dd>
        <dt>{{ trans('problem_view_forms.days') }}</dt>
        <dd>{{ $problemViewForm->days }}</dd>
        <dt>Dans un créneau horaire</dt>
        <dd>{{ $problemViewForm->minutes_per_slot }}mn</dd>
        <dt>Dans la journée</dt>
        <dd>{{ $problemInstance['slotsPerDay'] }} créneaux horaires</dd>
        <dt>Dans la semaine</dt>
        <dd>{{ $problemInstance['nrDays'] }} jours</dd>
        <dt>Dans le semestre</dt>
        <dd>{{ $problemInstance['nrWeeks'] }} semaines</dd>
        <dt>Optimisation</dt>
        @foreach ($problemInstance->optimization->attributes() as $_key => $_attr)
            <dd>{{ Str::ucfirst($_key) }} : {{ $_attr }} </dd>
        @endforeach

    </dl>

    <div class="row">
        <div class="col-sm-12">
            <a href="{{ route('problem_view_forms.problem_view_form.show', $problemViewForm->id) }}"
                class="btn btn-default"
                {{ Route::is('problem_view_forms.problem_view_form.show') ? 'disabled' : '' }}>Overview</a>
            <a href="{{ route('problem_view_forms.problem_view_form.rooms', $problemViewForm->id) }}"
                class="btn btn-default"
                {{ Route::is('problem_view_forms.problem_view_form.rooms') ? 'disabled' : '' }}>Rooms</a>
            <a href="{{ route('problem_view_forms.problem_view_form.courses', $problemViewForm->id) }}"
                class="btn btn-default"
                {{ Route::is('problem_view_forms.problem_view_form.courses') ? 'disabled' : '' }}>Courses</a>
            <a href="{{ route('problem_view_forms.problem_view_form.distributions', $problemViewForm->id) }}"
                class="btn btn-default"
                {{ Route::is('problem_view_forms.problem_view_form.distributions') ? 'disabled' : '' }}>Distribution
                Constraintes</a>
            <a href="{{ route('problem_view_forms.problem_view_form.students', $problemViewForm->id) }}"
                class="btn btn-default"
                {{ Route::is('problem_view_forms.problem_view_form.students') ? 'disabled' : '' }}>Students</a>
        </div>
    </div>
@endcomponent
