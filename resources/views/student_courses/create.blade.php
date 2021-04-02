@extends('layouts.app')

@section('content-header')
    <h1>
        Student Course
        <small>Nouveau </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class=""><a href="{{route('student_courses.student_course.index')}}">{{ trans('student_courses.model_plural') }}</a></li>
        <li class="active"><a href="{{route('student_courses.student_course.create')}}">Nouveau</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-form-create')
        @slot('headerLeft') {{ trans('student_courses.create') }} @endslot

        @slot('actions')
            <a href="{{ route('student_courses.student_course.index') }}" class="btn btn-primary" title="{{ trans('student_courses.show_all') }}">
                <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
            </a>
        @endslot

        @slot('route') {{ route('student_courses.student_course.store') }} @endslot

        @include ('student_courses.form', ['studentCourse' => null,])

    @endcomponent

@endsection


