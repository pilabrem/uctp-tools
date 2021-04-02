@extends('layouts.app')

@section('content-header')
    <h1>
        Class Possible Room
        <small>Nouveau </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class=""><a href="{{route('class_possible_rooms.class_possible_room.index')}}">{{ trans('class_possible_rooms.model_plural') }}</a></li>
        <li class="active"><a href="{{route('class_possible_rooms.class_possible_room.create')}}">Nouveau</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-form-create')
        @slot('headerLeft') {{ trans('class_possible_rooms.create') }} @endslot

        @slot('actions')
            <a href="{{ route('class_possible_rooms.class_possible_room.index') }}" class="btn btn-primary" title="{{ trans('class_possible_rooms.show_all') }}">
                <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
            </a>
        @endslot

        @slot('route') {{ route('class_possible_rooms.class_possible_room.store') }} @endslot

        @include ('class_possible_rooms.form', ['classPossibleRoom' => null,])

    @endcomponent

@endsection


