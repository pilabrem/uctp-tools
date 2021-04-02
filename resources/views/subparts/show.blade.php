@extends('layouts.app')

@section('content-header')
    <h1>
        Subpart
        <small>Détails </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class=""><a href="{{route('subparts.subpart.index')}}">{{ trans('subparts.model_plural') }}</a></li>
        <li class="active"><a href="{{route('subparts.subpart.show', $subpart->id)}}">Subpart</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-show')

        @slot('left')
            <h4 class="mt-5 mb-5">{{ !empty($subpart->name) ? $subpart->name : 'Subpart' }}</h4>
        @endslot

        @slot('right')
            <form method="POST" action="{!! route('subparts.subpart.destroy', $subpart->id) !!}" accept-charset="UTF-8">
                <input name="_method" value="DELETE" type="hidden">
                {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('subparts.subpart.index') }}" class="btn btn-primary" title="{{ trans('subparts.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('subparts.subpart.create') }}" class="btn btn-success" title="{{ trans('subparts.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>

                    <a href="{{route('subparts.subpart.edit', $subpart->id)}}" class="btn btn-primary" title="{{ trans('subparts.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="{{ trans('subparts.delete') }}" onclick="return confirm(&quot;{{ trans('subparts.confirm_delete') }}&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>
        @endslot

        <dl class="dl-horizontal">
                        <dt>{{ trans('subparts.name') }}</dt>
            <dd>{{ $subpart->name }}</dd>
            <dt>{{ trans('subparts.config_id') }}</dt>
            <dd>{{ optional($subpart->config)->name }}</dd>

        </dl>
    @endcomponent

@endsection