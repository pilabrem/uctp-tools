@extends('layouts.app')

@section('content-header')
    <h1>
        Solution Instance Viewer
        <small>Show </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class=""><a
                href="{{ route('solution_view_forms.solution_view_form.index') }}">{{ trans('solution_view_forms.model_plural') }}</a>
        </li>
        <li class="active"><a
                href="{{ route('solution_view_forms.solution_view_form.show', $solutionViewForm->id) }}">Solution View
                Form</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-show')

        @slot('left')
            <h4 class="mt-5 mb-5">
                {{-- {{ !empty($title) ? $title : 'Solution View Form' }} --}}

                <form action="" method="get" role="form" class="form-inline">
                    @csrf

                    <div class="form-group">
                        <label for="student" class="control-label" style="padding-right: 15px;">Etudiant</label>
                        <select name="student" id="student" class="form-control" style="margin-right: 15px; width: 100px;">
                            @foreach ($students as $_st)
                                <option value="{{ $_st }}" {{ old('student') == $_st ? 'selected' : '' }}>
                                    {{ $_st }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-default">Afficher le Programme</button>
                </form>
            </h4>
        @endslot

        @slot('right')
            <form method="POST" action="{!!  route('solution_view_forms.solution_view_form.destroy', $solutionViewForm->id) !!}"
                accept-charset="UTF-8">
                <input name="_method" value="DELETE" type="hidden">
                {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('solution_view_forms.solution_view_form.index') }}" class="btn btn-primary"
                        title="{{ trans('solution_view_forms.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('solution_view_forms.solution_view_form.create') }}" class="btn btn-success"
                        title="{{ trans('solution_view_forms.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('solution_view_forms.solution_view_form.edit', $solutionViewForm->id) }}"
                        class="btn btn-primary" title="{{ trans('solution_view_forms.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="{{ trans('solution_view_forms.delete') }}"
                        onclick="return confirm(&quot;{{ trans('solution_view_forms.confirm_delete') }}&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>
        @endslot

        <dl class="dl-horizontal">
            @foreach ($solutionInstance->attributes() as $_item => $_value)
                <dt>{{ Str::ucfirst($_item) }}</dt>
                <dd>{{ $_value }}</dd>
            @endforeach
            <dt>Début journée</dt>
            <dd>{{ $solutionViewForm->day_begin }}h</dd>
            <dt>Créneau horaire</dt>
            <dd>{{ $solutionViewForm->time_slot }}mn</dd>
            <dt>Par jour</dt>
            <dd>{{ $solutionViewForm->day_time_slots }} créneaux</dd>
            <dt>Jours de la semaine</dt>
            <dd>{{ $solutionViewForm->week_days }}</dd>
            <dt>Par semestre</dt>
            <dd>{{ $solutionViewForm->semester_weeks }} semaines</dd>

        </dl>
    @endcomponent


    @foreach ($classesByWeek as $_key => $_weekClasses)

        @component('components.box-index')
            @slot('left')
                <h4 class="mt-5 mb-5">Semaine {{ $_key + 1 }} </h4>
            @endslot

            @slot('right')
            @endslot

            @if (count($_weekClasses) == 0)
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="solutionViewForms" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    @foreach ($daysArray as $d)
                                        <th>{{ $d }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            @else
                <div class="box-body">
                    <div class="table-responsive">

                        <table id="solutionViewForms" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    @foreach ($daysArray as $d)
                                        <th>{{ $d }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @foreach ($_weekClasses as $_dayClasses)
                                        <td>
                                            @foreach ($_dayClasses as $_classe)
                                                <b>{{ $_classe['start_hour'] }}</b> - {{ $_classe['id'] }}
                                                ({{ $_classe['room'] }}) <br> <br>
                                            @endforeach
                                        </td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>

                <div class="box-footer">
                    {{-- {!!  $solutionViewForms->render() !!} --}}
                </div>

            @endif
        @endcomponent

    @endforeach

@endsection
