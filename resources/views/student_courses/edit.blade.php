@extends('layouts.app')

@section('content-header')
    <h1>
        Student Course
        <small>Modification </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class=""><a href="{{route('student_courses.student_course.index')}}">{{ trans('student_courses.model_plural') }}</a></li>
        <li class=""><a href="{{route('student_courses.student_course.show', $studentCourse->id)}}">Student Course</a></li>
        <li class="active"><a href="{{route('student_courses.student_course.edit', $studentCourse->id)}}">Modification</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-form-edit')
        @slot('headerLeft') {{ !empty($title) ? $title : 'Student Course' }} @endslot

        @slot('actions')
            <a href="{{ route('student_courses.student_course.index') }}" class="btn btn-primary" title="{{ trans('student_courses.show_all') }}">
                <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
            </a>

            <a href="{{ route('student_courses.student_course.create') }}" class="btn btn-success" title="{{ trans('student_courses.create') }}">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            </a>
        @endslot

        @slot('route') {{ route('student_courses.student_course.update', $studentCourse->id) }} @endslot

        @include ('student_courses.form', ['studentCourse' => $studentCourse,])

    @endcomponent

@endsection