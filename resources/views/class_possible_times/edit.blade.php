@extends('layouts.app')

@section('content-header')
    <h1>
        Class Possible Time
        <small>Modification </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class=""><a href="{{route('class_possible_times.class_possible_time.index')}}">{{ trans('class_possible_times.model_plural') }}</a></li>
        <li class=""><a href="{{route('class_possible_times.class_possible_time.show', $classPossibleTime->id)}}">Class Possible Time</a></li>
        <li class="active"><a href="{{route('class_possible_times.class_possible_time.edit', $classPossibleTime->id)}}">Modification</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-form-edit')
        @slot('headerLeft') {{ !empty($title) ? $title : 'Class Possible Time' }} @endslot

        @slot('actions')
            <a href="{{ route('class_possible_times.class_possible_time.index') }}" class="btn btn-primary" title="{{ trans('class_possible_times.show_all') }}">
                <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
            </a>

            <a href="{{ route('class_possible_times.class_possible_time.create') }}" class="btn btn-success" title="{{ trans('class_possible_times.create') }}">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            </a>
        @endslot

        @slot('route') {{ route('class_possible_times.class_possible_time.update', $classPossibleTime->id) }} @endslot

        @include ('class_possible_times.form', ['classPossibleTime' => $classPossibleTime,])

    @endcomponent

@endsection