@extends('layouts.app')

@section('content-header')
    <h1>
        Settings
        <small>Affichage </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class="active"><a href="{{ route('settings.setting.index') }}">Settings</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-index')
            @slot('left')
                <h4 class="mt-5 mb-5">Settings</h4>
            @endslot

            @slot('right')
                <a href="{{ route('settings.setting.create') }}" class="btn btn-success" title="Ajouter Setting">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>
            @endslot

            @if(count($settings) == 0)
                <div class="box-body">
                    <h4>Aucun Setting Trouvé!</h4>
                </div>
            @else
                <div class="box-body">
                    <div class="table-responsive">

                        <table id="settings" class="table table-striped table-hover">
                            <thead>
                            <tr>
                                                            <th>Paramètre</th>
                            <th>Valeur</th>


                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($settings as $setting)
                                <tr>
                                                                <td>{{ $setting->key }}</td>
                            <td>{{ $setting->value }}</td>


                                    <td>

                                        <form method="POST" action="{!! route('settings.setting.destroy', $setting->id) !!}" accept-charset="UTF-8">
                                            <input name="_method" value="DELETE" type="hidden">
                                            {{ csrf_field() }}

                                            <div class="btn-group btn-group-xs pull-right" role="group">
                                                <a href="{{ route('settings.setting.show', $setting->id ) }}" class="btn btn-info" title="Afficher Setting">
                                                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                                </a>
                                                <a href="{{ route('settings.setting.edit', $setting->id) }}" class="btn btn-primary" title="Modifier Setting">
                                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                                </a>

                                                <button type="submit" class="btn btn-danger" title="Supprimer Setting" onclick="return confirm(&quot;Supprimer Setting?&quot;)">
                                                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                                </button>
                                            </div>

                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>

                <div class="box-footer">
                    {!! $settings->render() !!}
                </div>

            @endif
        @endcomponent

@endsection