@extends('layouts.app')

@section('content-header')
    <h1>
        Room
        <small>Modification </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class=""><a href="{{route('rooms.room.index')}}">{{ trans('rooms.model_plural') }}</a></li>
        <li class=""><a href="{{route('rooms.room.show', $room->id)}}">Room</a></li>
        <li class="active"><a href="{{route('rooms.room.edit', $room->id)}}">Modification</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-form-edit')
        @slot('headerLeft') {{ !empty($title) ? $title : 'Room' }} @endslot

        @slot('actions')
            <a href="{{ route('rooms.room.index') }}" class="btn btn-primary" title="{{ trans('rooms.show_all') }}">
                <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
            </a>

            <a href="{{ route('rooms.room.create') }}" class="btn btn-success" title="{{ trans('rooms.create') }}">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            </a>
        @endslot

        @slot('route') {{ route('rooms.room.update', $room->id) }} @endslot

        @include ('rooms.form', ['room' => $room,])

    @endcomponent

@endsection