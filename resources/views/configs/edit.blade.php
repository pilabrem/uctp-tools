@extends('layouts.app')

@section('content-header')
    <h1>
        Config
        <small>Modification </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class=""><a href="{{route('configs.config.index')}}">{{ trans('configs.model_plural') }}</a></li>
        <li class=""><a href="{{route('configs.config.show', $config->id)}}">Config</a></li>
        <li class="active"><a href="{{route('configs.config.edit', $config->id)}}">Modification</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-form-edit')
        @slot('headerLeft') {{ !empty($config->name) ? $config->name : 'Config' }} @endslot

        @slot('actions')
            <a href="{{ route('configs.config.index') }}" class="btn btn-primary" title="{{ trans('configs.show_all') }}">
                <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
            </a>

            <a href="{{ route('configs.config.create') }}" class="btn btn-success" title="{{ trans('configs.create') }}">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            </a>
        @endslot

        @slot('route') {{ route('configs.config.update', $config->id) }} @endslot

        @include ('configs.form', ['config' => $config,])

    @endcomponent

@endsection