@extends('layouts.app')

@section('content-header')
    <h1>
        Problem
        <small>Modification </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class=""><a href="{{route('problems.problem.index')}}">{{ trans('problems.model_plural') }}</a></li>
        <li class=""><a href="{{route('problems.problem.show', $problem->id)}}">Problem</a></li>
        <li class="active"><a href="{{route('problems.problem.edit', $problem->id)}}">Modification</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-form-edit')
        @slot('headerLeft') {{ !empty($problem->name) ? $problem->name : 'Problem' }} @endslot

        @slot('actions')
            <a href="{{ route('problems.problem.index') }}" class="btn btn-primary" title="{{ trans('problems.show_all') }}">
                <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
            </a>

            <a href="{{ route('problems.problem.create') }}" class="btn btn-success" title="{{ trans('problems.create') }}">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            </a>
        @endslot

        @slot('route') {{ route('problems.problem.update', $problem->id) }} @endslot

        @include ('problems.form', ['problem' => $problem,])

    @endcomponent

@endsection