@extends('layouts.app')

@section('content-header')
    <h1>
        Travel
        <small>Modification </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class=""><a href="{{route('travel.travel.index')}}">{{ trans('travel.model_plural') }}</a></li>
        <li class=""><a href="{{route('travel.travel.show', $travel->id)}}">Travel</a></li>
        <li class="active"><a href="{{route('travel.travel.edit', $travel->id)}}">Modification</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-form-edit')
        @slot('headerLeft') {{ !empty($title) ? $title : 'Travel' }} @endslot

        @slot('actions')
            <a href="{{ route('travel.travel.index') }}" class="btn btn-primary" title="{{ trans('travel.show_all') }}">
                <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
            </a>

            <a href="{{ route('travel.travel.create') }}" class="btn btn-success" title="{{ trans('travel.create') }}">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            </a>
        @endslot

        @slot('route') {{ route('travel.travel.update', $travel->id) }} @endslot

        @include ('travel.form', ['travel' => $travel,])

    @endcomponent

@endsection