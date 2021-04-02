@extends('layouts.app')

@section('content-header')
    <h1>
        Subpart
        <small>Modification </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class=""><a href="{{route('subparts.subpart.index')}}">{{ trans('subparts.model_plural') }}</a></li>
        <li class=""><a href="{{route('subparts.subpart.show', $subpart->id)}}">Subpart</a></li>
        <li class="active"><a href="{{route('subparts.subpart.edit', $subpart->id)}}">Modification</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-form-edit')
        @slot('headerLeft') {{ !empty($subpart->name) ? $subpart->name : 'Subpart' }} @endslot

        @slot('actions')
            <a href="{{ route('subparts.subpart.index') }}" class="btn btn-primary" title="{{ trans('subparts.show_all') }}">
                <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
            </a>

            <a href="{{ route('subparts.subpart.create') }}" class="btn btn-success" title="{{ trans('subparts.create') }}">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            </a>
        @endslot

        @slot('route') {{ route('subparts.subpart.update', $subpart->id) }} @endslot

        @include ('subparts.form', ['subpart' => $subpart,])

    @endcomponent

@endsection