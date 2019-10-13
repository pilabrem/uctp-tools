@extends('layouts.app')

@section('content-header')
    <h1>
        Setting
        <small>Modification </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class=""><a href="{{route('settings.setting.index')}}">Settings</a></li>
        <li class=""><a href="{{route('settings.setting.show', $setting->id)}}">Setting</a></li>
        <li class="active"><a href="{{route('settings.setting.edit', $setting->id)}}">Modification</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-form-edit')
        @slot('headerLeft') {{ !empty($title) ? $title : 'Setting' }} @endslot

        @slot('actions')
            <a href="{{ route('settings.setting.index') }}" class="btn btn-primary" title="Afficher tous les Setting">
                <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
            </a>

            <a href="{{ route('settings.setting.create') }}" class="btn btn-success" title="Ajouter Setting">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            </a>
        @endslot

        @slot('route') {{ route('settings.setting.update', $setting->id) }} @endslot

        @include ('settings.form', ['setting' => $setting,])

    @endcomponent

@endsection