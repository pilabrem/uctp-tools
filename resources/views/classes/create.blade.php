@extends('layouts.app')

@section('content-header')
    <h1>
        Classe
        <small>Nouveau </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class=""><a href="{{route('classes.classe.index')}}">{{ trans('classes.model_plural') }}</a></li>
        <li class="active"><a href="{{route('classes.classe.create')}}">Nouveau</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-form-create')
        @slot('headerLeft') {{ trans('classes.create') }} @endslot

        @slot('actions')
            <a href="{{ route('classes.classe.index') }}" class="btn btn-primary" title="{{ trans('classes.show_all') }}">
                <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
            </a>
        @endslot

        @slot('route') {{ route('classes.classe.store') }} @endslot

        @include ('classes.form', ['classe' => null,])

    @endcomponent

@endsection


