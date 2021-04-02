@extends('layouts.app')

@section('content-header')
    <h1>
        Problem
        <small>Nouveau </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class=""><a href="{{route('problems.problem.index')}}">{{ trans('problems.model_plural') }}</a></li>
        <li class="active"><a href="{{route('problems.problem.create')}}">Nouveau</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-form-create')
        @slot('headerLeft') {{ trans('problems.create') }} @endslot

        @slot('actions')
            <a href="{{ route('problems.problem.index') }}" class="btn btn-primary" title="{{ trans('problems.show_all') }}">
                <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
            </a>
        @endslot

        @slot('route') {{ route('problems.problem.store') }} @endslot

        @include ('problems.form', ['problem' => null,])

    @endcomponent

@endsection


