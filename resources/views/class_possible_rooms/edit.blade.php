@extends('layouts.app')

@section('content-header')
    <h1>
        Class Possible Room
        <small>Modification </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class=""><a href="{{route('class_possible_rooms.class_possible_room.index')}}">{{ trans('class_possible_rooms.model_plural') }}</a></li>
        <li class=""><a href="{{route('class_possible_rooms.class_possible_room.show', $classPossibleRoom->id)}}">Class Possible Room</a></li>
        <li class="active"><a href="{{route('class_possible_rooms.class_possible_room.edit', $classPossibleRoom->id)}}">Modification</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-form-edit')
        @slot('headerLeft') {{ !empty($title) ? $title : 'Class Possible Room' }} @endslot

        @slot('actions')
            <a href="{{ route('class_possible_rooms.class_possible_room.index') }}" class="btn btn-primary" title="{{ trans('class_possible_rooms.show_all') }}">
                <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
            </a>

            <a href="{{ route('class_possible_rooms.class_possible_room.create') }}" class="btn btn-success" title="{{ trans('class_possible_rooms.create') }}">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            </a>
        @endslot

        @slot('route') {{ route('class_possible_rooms.class_possible_room.update', $classPossibleRoom->id) }} @endslot

        @include ('class_possible_rooms.form', ['classPossibleRoom' => $classPossibleRoom,])

    @endcomponent

@endsection