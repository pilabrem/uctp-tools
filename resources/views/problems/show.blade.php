@extends('layouts.app')

@section('content-header')
    <h1>
        Problem
        <small>Détails </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class=""><a href="{{ route('problems.problem.index') }}">{{ trans('problems.model_plural') }}</a></li>
        <li class="active"><a href="{{ route('problems.problem.show', $problem->id) }}">Problem</a></li>
    </ol>
@endsection

@section('content')

    @include('problems.sub.overview')

@endsection
