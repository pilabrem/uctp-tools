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


    {{-- Liste des contraintes de distribution --}}
    @component('components.box-show')

        @slot('left')
            <h4 class="mt-5 mb-5">Contraintes de distribution</h4>
        @endslot

        @slot('right')
        @endslot

        <table id="problemViewForms" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Contrainte</th>
                    <th>Requise</th>
                    <th>Penalités</th>
                    <th>Cours (class)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($problemInstance->distributions->distribution as $_distribution)
                    <tr>
                        <td>{{ $_distribution['type'] }}</td>
                        <td>{{ $_distribution['required'] }}</td>
                        <td>
                            {{ $_distribution['penalty'] }}
                        </td>
                        <td>
                            @foreach ($_distribution->class as $_class)
                                {{ $_class['id'] }} <br>
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endcomponent



@endsection
