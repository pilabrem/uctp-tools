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


    {{-- Liste des cours --}}
    @component('components.box-show')

        @slot('left')
            <h4 class="mt-5 mb-5">Cours</h4>
        @endslot

        @slot('right')
        @endslot

        <table id="problemViewForms" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Course</th>
                    <th>Config</th>
                    <th>Subpart</th>
                    <th>Class</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($problemInstance->courses->course as $_course)
                    <tr>
                        <td>{{ $_course['id'] }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @foreach ($_course->config as $_config)
                        <tr>
                            <td></td>
                            <td>{{ $_config['id'] }}</td>
                            <td></td>
                            <td></td>
                        </tr>
                        @foreach ($_config->subpart as $_subpart)
                            <tr>
                                <td></td>
                                <td></td>
                                <td>{{ $_subpart['id'] }}</td>
                                <td></td>
                            </tr>
                            @foreach ($_subpart->class as $_class)
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        {{ $_class['id'] }} ({{ $_class['limit'] }}) @if (isset($_class['parent']))
                                            , parent : {{ $_class['parent'] }}
                                        @endif
                                        <br>
                                        @if (isset($_class->room))
                                            <br>
                                            <table style="width: 100%;">
                                                <caption>Possible rooms</caption>
                                                <tr>
                                                    <th>Room</th>
                                                    <th>Penalty</th>
                                                </tr>
                                                @foreach ($_class->room as $_room)
                                                    <tr>
                                                        <td>{{ $_room['id'] }}</td>
                                                        <td>{{ $_room['penalty'] }}</td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        @endif
                                        <br>
                                        @if (isset($_class->time))
                                            <table style="width: 100%;">
                                                <caption>Possible time slots</caption>
                                                <tr>
                                                    <th>Weeks</th>
                                                    <th>Days</th>
                                                    <th>Start</th>
                                                    <th>End</th>
                                                    <th>Penalty</th>
                                                </tr>
                                                @foreach ($_class->time as $_time)
                                                    <tr>
                                                        <td>{{ $problemViewForm->getWeeks((string) $_time['weeks']) }}</td>
                                                        <td>{{ $problemViewForm->getDays((string) $_time['days']) }}</td>
                                                        <td>{{ $problemViewForm->getHour(intval($_time['start'])) }}</td>
                                                        <td>
                                                            {{ $problemViewForm->getHour(intval($_time['start']) + intval($_time['length'])) }}
                                                        </td>
                                                        <td>{{ $_time['penalty'] }}</td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    @endforeach
                @endforeach
            </tbody>
        </table>
    @endcomponent


@endsection
