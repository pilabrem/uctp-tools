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


    {{-- Liste des Etudiants --}}
    @component('components.box-show')

        @slot('left')
            <h4 class="mt-5 mb-5">Etudiants</h4>
        @endslot

        @slot('right')
        @endslot

        <table id="problemViewForms" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Etudiant</th>
                    <th>Cours (class)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($problemInstance->students->student as $_student)
                    <tr>
                        <td>{{ $_student['id'] }}</td>
                        <td>
                            @foreach ($_student->course as $_ecourse)
                                {{ $_ecourse['id'] }} <br>
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endcomponent

@endsection
