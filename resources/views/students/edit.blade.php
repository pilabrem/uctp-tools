@extends('layouts.app')

@section('content-header')
    <h1>
        Student
        <small>Modification </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class=""><a href="{{route('students.student.index')}}">{{ trans('students.model_plural') }}</a></li>
        <li class=""><a href="{{route('students.student.show', $student->id)}}">Student</a></li>
        <li class="active"><a href="{{route('students.student.edit', $student->id)}}">Modification</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-form-edit')
        @slot('headerLeft') {{ !empty($student->name) ? $student->name : 'Student' }} @endslot

        @slot('actions')
            <a href="{{ route('students.student.index') }}" class="btn btn-primary" title="{{ trans('students.show_all') }}">
                <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
            </a>

            <a href="{{ route('students.student.create') }}" class="btn btn-success" title="{{ trans('students.create') }}">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            </a>
        @endslot

        @slot('route') {{ route('students.student.update', $student->id) }} @endslot

        @include ('students.form', ['student' => $student,])

    @endcomponent

@endsection