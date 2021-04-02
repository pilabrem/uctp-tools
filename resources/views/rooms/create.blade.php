@extends('layouts.app')

@section('content-header')
    <h1>
        Room
        <small>Nouveau </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class=""><a href="{{route('rooms.room.index')}}">{{ trans('rooms.model_plural') }}</a></li>
        <li class="active"><a href="{{route('rooms.room.create')}}">Nouveau</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-form-create')
        @slot('headerLeft') {{ trans('rooms.create') }} @endslot

        @slot('actions')
            <a href="{{ route('rooms.room.index') }}" class="btn btn-primary" title="{{ trans('rooms.show_all') }}">
                <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
            </a>
        @endslot

        @slot('route') {{ route('rooms.room.store') }} @endslot

        @include ('rooms.form', ['room' => null,])

    @endcomponent

@endsection


