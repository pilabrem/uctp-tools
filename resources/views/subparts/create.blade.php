@extends('layouts.app')

@section('content-header')
    <h1>
        Subpart
        <small>Nouveau </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class=""><a href="{{route('subparts.subpart.index')}}">{{ trans('subparts.model_plural') }}</a></li>
        <li class="active"><a href="{{route('subparts.subpart.create')}}">Nouveau</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-form-create')
        @slot('headerLeft') {{ trans('subparts.create') }} @endslot

        @slot('actions')
            <a href="{{ route('subparts.subpart.index') }}" class="btn btn-primary" title="{{ trans('subparts.show_all') }}">
                <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
            </a>
        @endslot

        @slot('route') {{ route('subparts.subpart.store') }} @endslot

        @include ('subparts.form', ['subpart' => null,])

    @endcomponent

@endsection


