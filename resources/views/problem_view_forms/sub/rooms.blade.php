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

    @include('problem_view_forms.sub.overview')


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
                        <td>
                            @foreach ($_room->travel as $_travel)
                                {{ $_travel['room'] }} -
                                {{ intval($_travel['value']) * $problemViewForm->minutes_per_slot }}mn <br><br>
                            @endforeach
                        </td>
                        <td>
                            @foreach ($_room->unavailable as $_unavailable)
                                Semaines:
                                {{ $problemViewForm->getWeeks((string) $_unavailable['weeks']) }}
                                - Jours :
                                {{ $problemViewForm->getDays((string) $_unavailable['days']) }}
                                de
                                {{ $problemViewForm->getHour(intval($_unavailable['start'])) }}
                                à
                                {{ $problemViewForm->getHour(intval($_unavailable['start']) + intval($_unavailable['length'])) }}
                                <br>
                                <br>
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endcomponent


@endsection
