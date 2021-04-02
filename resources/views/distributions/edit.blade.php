@extends('layouts.app')

@section('content-header')
    <h1>
        Distribution
        <small>Modification </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class=""><a href="{{route('distributions.distribution.index')}}">{{ trans('distributions.model_plural') }}</a></li>
        <li class=""><a href="{{route('distributions.distribution.show', $distribution->id)}}">Distribution</a></li>
        <li class="active"><a href="{{route('distributions.distribution.edit', $distribution->id)}}">Modification</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-form-edit')
        @slot('headerLeft') {{ !empty($title) ? $title : 'Distribution' }} @endslot

        @slot('actions')
            <a href="{{ route('distributions.distribution.index') }}" class="btn btn-primary" title="{{ trans('distributions.show_all') }}">
                <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
            </a>

            <a href="{{ route('distributions.distribution.create') }}" class="btn btn-success" title="{{ trans('distributions.create') }}">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            </a>
        @endslot

        @slot('route') {{ route('distributions.distribution.update', $distribution->id) }} @endslot

        @include ('distributions.form', ['distribution' => $distribution,])

    @endcomponent

@endsection