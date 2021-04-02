@extends('layouts.app')

@section('content-header')
    <h1>
        Config
        <small>Détails </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class=""><a href="{{route('configs.config.index')}}">{{ trans('configs.model_plural') }}</a></li>
        <li class="active"><a href="{{route('configs.config.show', $config->id)}}">Config</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-show')

        @slot('left')
            <h4 class="mt-5 mb-5">{{ !empty($config->name) ? $config->name : 'Config' }}</h4>
        @endslot

        @slot('right')
            <form method="POST" action="{!! route('configs.config.destroy', $config->id) !!}" accept-charset="UTF-8">
                <input name="_method" value="DELETE" type="hidden">
                {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('configs.config.index') }}" class="btn btn-primary" title="{{ trans('configs.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('configs.config.create') }}" class="btn btn-success" title="{{ trans('configs.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>

                    <a href="{{route('configs.config.edit', $config->id)}}" class="btn btn-primary" title="{{ trans('configs.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="{{ trans('configs.delete') }}" onclick="return confirm(&quot;{{ trans('configs.confirm_delete') }}&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>
        @endslot

        <dl class="dl-horizontal">
                        <dt>{{ trans('configs.name') }}</dt>
            <dd>{{ $config->name }}</dd>
            <dt>{{ trans('configs.course_id') }}</dt>
            <dd>{{ optional($config->course)->name }}</dd>

        </dl>
    @endcomponent

@endsection