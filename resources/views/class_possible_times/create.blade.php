@extends('layouts.app')

@section('content-header')
    <h1>
        Class Possible Time
        <small>Nouveau </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class=""><a href="{{route('class_possible_times.class_possible_time.index')}}">{{ trans('class_possible_times.model_plural') }}</a></li>
        <li class="active"><a href="{{route('class_possible_times.class_possible_time.create')}}">Nouveau</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-form-create')
        @slot('headerLeft') {{ trans('class_possible_times.create') }} @endslot

        @slot('actions')
            <a href="{{ route('class_possible_times.class_possible_time.index') }}" class="btn btn-primary" title="{{ trans('class_possible_times.show_all') }}">
                <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
            </a>
        @endslot

        @slot('route') {{ route('class_possible_times.class_possible_time.store') }} @endslot

        @include ('class_possible_times.form', ['classPossibleTime' => null,])

    @endcomponent

@endsection


