@extends('layouts.app')

@section('content-header')
    <h1>
        Room Unavailable
        <small>Modification </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class=""><a href="{{route('room_unavailables.room_unavailable.index')}}">{{ trans('room_unavailables.model_plural') }}</a></li>
        <li class=""><a href="{{route('room_unavailables.room_unavailable.show', $roomUnavailable->id)}}">Room Unavailable</a></li>
        <li class="active"><a href="{{route('room_unavailables.room_unavailable.edit', $roomUnavailable->id)}}">Modification</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-form-edit')
        @slot('headerLeft') {{ !empty($title) ? $title : 'Room Unavailable' }} @endslot

        @slot('actions')
            <a href="{{ route('room_unavailables.room_unavailable.index') }}" class="btn btn-primary" title="{{ trans('room_unavailables.show_all') }}">
                <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
            </a>

            <a href="{{ route('room_unavailables.room_unavailable.create') }}" class="btn btn-success" title="{{ trans('room_unavailables.create') }}">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            </a>
        @endslot

        @slot('route') {{ route('room_unavailables.room_unavailable.update', $roomUnavailable->id) }} @endslot

        @include ('room_unavailables.form', ['roomUnavailable' => $roomUnavailable,])

    @endcomponent

@endsection