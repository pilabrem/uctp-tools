@extends('layouts.app')

@section('content-header')
    <h1>
        Course
        <small>Nouveau </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class=""><a href="{{route('courses.course.index')}}">{{ trans('courses.model_plural') }}</a></li>
        <li class="active"><a href="{{route('courses.course.create')}}">Nouveau</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-form-create')
        @slot('headerLeft') {{ trans('courses.create') }} @endslot

        @slot('actions')
            <a href="{{ route('courses.course.index') }}" class="btn btn-primary" title="{{ trans('courses.show_all') }}">
                <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
            </a>
        @endslot

        @slot('route') {{ route('courses.course.store') }} @endslot

        @include ('courses.form', ['course' => null,])

    @endcomponent

@endsection


