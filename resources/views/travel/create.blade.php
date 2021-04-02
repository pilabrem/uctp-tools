@extends('layouts.app')

@section('content-header')
    <h1>
        Travel
        <small>Nouveau </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class=""><a href="{{route('travel.travel.index')}}">{{ trans('travel.model_plural') }}</a></li>
        <li class="active"><a href="{{route('travel.travel.create')}}">Nouveau</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-form-create')
        @slot('headerLeft') {{ trans('travel.create') }} @endslot

        @slot('actions')
            <a href="{{ route('travel.travel.index') }}" class="btn btn-primary" title="{{ trans('travel.show_all') }}">
                <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
            </a>
        @endslot

        @slot('route') {{ route('travel.travel.store') }} @endslot

        @include ('travel.form', ['travel' => null,])

    @endcomponent

@endsection


