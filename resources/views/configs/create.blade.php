@extends('layouts.app')

@section('content-header')
    <h1>
        Config
        <small>Nouveau </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class=""><a href="{{route('configs.config.index')}}">{{ trans('configs.model_plural') }}</a></li>
        <li class="active"><a href="{{route('configs.config.create')}}">Nouveau</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-form-create')
        @slot('headerLeft') {{ trans('configs.create') }} @endslot

        @slot('actions')
            <a href="{{ route('configs.config.index') }}" class="btn btn-primary" title="{{ trans('configs.show_all') }}">
                <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
            </a>
        @endslot

        @slot('route') {{ route('configs.config.store') }} @endslot

        @include ('configs.form', ['config' => null,])

    @endcomponent

@endsection


