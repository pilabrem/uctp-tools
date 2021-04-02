@extends('layouts.app')

@section('content-header')
    <h1>
        Distribution Class
        <small>Nouveau </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class=""><a href="{{route('distribution_classes.distribution_class.index')}}">{{ trans('distribution_classes.model_plural') }}</a></li>
        <li class="active"><a href="{{route('distribution_classes.distribution_class.create')}}">Nouveau</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-form-create')
        @slot('headerLeft') {{ trans('distribution_classes.create') }} @endslot

        @slot('actions')
            <a href="{{ route('distribution_classes.distribution_class.index') }}" class="btn btn-primary" title="{{ trans('distribution_classes.show_all') }}">
                <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
            </a>
        @endslot

        @slot('route') {{ route('distribution_classes.distribution_class.store') }} @endslot

        @include ('distribution_classes.form', ['distributionClass' => null,])

    @endcomponent

@endsection


