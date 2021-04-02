@extends('layouts.app')

@section('content-header')
    <h1>
        Classe
        <small>Modification </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class=""><a href="{{route('classes.classe.index')}}">{{ trans('classes.model_plural') }}</a></li>
        <li class=""><a href="{{route('classes.classe.show', $classe->id)}}">Classe</a></li>
        <li class="active"><a href="{{route('classes.classe.edit', $classe->id)}}">Modification</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-form-edit')
        @slot('headerLeft') {{ !empty($classe->name) ? $classe->name : 'Classe' }} @endslot

        @slot('actions')
            <a href="{{ route('classes.classe.index') }}" class="btn btn-primary" title="{{ trans('classes.show_all') }}">
                <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
            </a>

            <a href="{{ route('classes.classe.create') }}" class="btn btn-success" title="{{ trans('classes.create') }}">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            </a>
        @endslot

        @slot('route') {{ route('classes.classe.update', $classe->id) }} @endslot

        @include ('classes.form', ['classe' => $classe,])

    @endcomponent

@endsection