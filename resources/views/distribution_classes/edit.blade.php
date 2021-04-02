@extends('layouts.app')

@section('content-header')
    <h1>
        Distribution Class
        <small>Modification </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class=""><a href="{{route('distribution_classes.distribution_class.index')}}">{{ trans('distribution_classes.model_plural') }}</a></li>
        <li class=""><a href="{{route('distribution_classes.distribution_class.show', $distributionClass->id)}}">Distribution Class</a></li>
        <li class="active"><a href="{{route('distribution_classes.distribution_class.edit', $distributionClass->id)}}">Modification</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-form-edit')
        @slot('headerLeft') {{ !empty($title) ? $title : 'Distribution Class' }} @endslot

        @slot('actions')
            <a href="{{ route('distribution_classes.distribution_class.index') }}" class="btn btn-primary" title="{{ trans('distribution_classes.show_all') }}">
                <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
            </a>

            <a href="{{ route('distribution_classes.distribution_class.create') }}" class="btn btn-success" title="{{ trans('distribution_classes.create') }}">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            </a>
        @endslot

        @slot('route') {{ route('distribution_classes.distribution_class.update', $distributionClass->id) }} @endslot

        @include ('distribution_classes.form', ['distributionClass' => $distributionClass,])

    @endcomponent

@endsection