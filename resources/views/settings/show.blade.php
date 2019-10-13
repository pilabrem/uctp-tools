@extends('layouts.app')

@section('content-header')
    <h1>
        Setting
        <small>Détails </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class=""><a href="{{route('settings.setting.index')}}">Settings</a></li>
        <li class="active"><a href="{{route('settings.setting.show', $setting->id)}}">Setting</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-show')

        @slot('left')
            <h4 class="mt-5 mb-5">{{ !empty($title) ? $title : 'Setting' }}</h4>
        @endslot

        @slot('right')
            <form method="POST" action="{!! route('settings.setting.destroy', $setting->id) !!}" accept-charset="UTF-8">
                <input name="_method" value="DELETE" type="hidden">
                {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('settings.setting.index') }}" class="btn btn-primary" title="Afficher tous les Setting">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('settings.setting.create') }}" class="btn btn-success" title="Ajouter Setting">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>

                    <a href="{{route('settings.setting.edit', $setting->id)}}" class="btn btn-primary" title="Modifier Setting">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Supprimer Setting" onclick="return confirm(&quot;Supprimer Setting?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>
        @endslot

        <dl class="dl-horizontal">
                        <dt>Paramètre</dt>
            <dd>{{ $setting->key }}</dd>
            <dt>Valeur</dt>
            <dd>{{ $setting->value }}</dd>

        </dl>
    @endcomponent

@endsection