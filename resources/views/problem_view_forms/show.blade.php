@extends('layouts.app')

@section('content-header')
    <h1>
        {{ __('Problem instance viewer') }}
        <small>Show </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class=""><a
                href="{{ route('problem_view_forms.problem_view_form.index') }}">{{ trans('problem_view_forms.model_plural') }}</a>
        </li>
        <li class="active"><a
                href="{{ route('problem_view_forms.problem_view_form.show', $problemViewForm->id) }}">Problem
                View Form</a></li>
    </ol>
@endsection

@section('content')

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
    @endcomponent


    {{-- Liste des salles --}}
    @component('components.box-show')

        @slot('left')
            <h4 class="mt-5 mb-5">Salles</h4>
        @endslot

        @slot('right')
        @endslot

        <table id="problemViewForms" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Salle</th>
                    <th>Capacité</th>
                    <th>Trajets</th>
                    <th>Indisponiblités</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($problemInstance->rooms->room as $_room)
                    <tr>
                        <td>{{ $_room['id'] }}</td>
                        <td>{{ $_room['capacity'] }}</td>
                        <td></td>
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endcomponent

@endsection
