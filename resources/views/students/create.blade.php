@extends('layouts.app')

@section('content-header')
    <h1>
        Student
        <small>Nouveau </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class=""><a href="{{route('students.student.index')}}">{{ trans('students.model_plural') }}</a></li>
        <li class="active"><a href="{{route('students.student.create')}}">Nouveau</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-form-create')
        @slot('headerLeft') {{ trans('students.create') }} @endslot

        @slot('actions')
            <a href="{{ route('students.student.index') }}" class="btn btn-primary" title="{{ trans('students.show_all') }}">
                <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
            </a>
        @endslot

        @slot('route') {{ route('students.student.store') }} @endslot

        @include ('students.form', ['student' => null,])

    @endcomponent

@endsection


