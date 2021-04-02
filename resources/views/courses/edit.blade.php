@extends('layouts.app')

@section('content-header')
    <h1>
        Course
        <small>Modification </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class=""><a href="{{route('courses.course.index')}}">{{ trans('courses.model_plural') }}</a></li>
        <li class=""><a href="{{route('courses.course.show', $course->id)}}">Course</a></li>
        <li class="active"><a href="{{route('courses.course.edit', $course->id)}}">Modification</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-form-edit')
        @slot('headerLeft') {{ !empty($course->name) ? $course->name : 'Course' }} @endslot

        @slot('actions')
            <a href="{{ route('courses.course.index') }}" class="btn btn-primary" title="{{ trans('courses.show_all') }}">
                <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
            </a>

            <a href="{{ route('courses.course.create') }}" class="btn btn-success" title="{{ trans('courses.create') }}">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            </a>
        @endslot

        @slot('route') {{ route('courses.course.update', $course->id) }} @endslot

        @include ('courses.form', ['course' => $course,])

    @endcomponent

@endsection