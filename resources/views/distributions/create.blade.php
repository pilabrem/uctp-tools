@extends('layouts.app')

@section('content-header')
    <h1>
        Distribution
        <small>Nouveau </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class=""><a href="{{route('distributions.distribution.index')}}">{{ trans('distributions.model_plural') }}</a></li>
        <li class="active"><a href="{{route('distributions.distribution.create')}}">Nouveau</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-form-create')
        @slot('headerLeft') {{ trans('distributions.create') }} @endslot

        @slot('actions')
            <a href="{{ route('distributions.distribution.index') }}" class="btn btn-primary" title="{{ trans('distributions.show_all') }}">
                <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
            </a>
        @endslot

        @slot('route') {{ route('distributions.distribution.store') }} @endslot

        @include ('distributions.form', ['distribution' => null,])

    @endcomponent

@endsection


