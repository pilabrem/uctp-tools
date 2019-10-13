@extends('layouts.app')

@section('content-header')
    <h1>
        Setting
        <small>Nouveau </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class=""><a href="{{route('settings.setting.index')}}">Settings</a></li>
        <li class="active"><a href="{{route('settings.setting.create')}}">Nouveau</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-form-create')
        @slot('headerLeft') Ajouter Setting @endslot

        @slot('actions')
            <a href="{{ route('settings.setting.index') }}" class="btn btn-primary" title="Afficher tous les Setting">
                <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
            </a>
        @endslot

        @slot('route') {{ route('settings.setting.store') }} @endslot

        @include ('settings.form', ['setting' => null,])

    @endcomponent

@endsection


