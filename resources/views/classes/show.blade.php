@extends('layouts.app')

@section('content-header')
    <h1>
        Classe
        <small>Détails </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class=""><a href="{{route('classes.classe.index')}}">{{ trans('classes.model_plural') }}</a></li>
        <li class="active"><a href="{{route('classes.classe.show', $classe->id)}}">Classe</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-show')

        @slot('left')
            <h4 class="mt-5 mb-5">{{ !empty($classe->name) ? $classe->name : 'Classe' }}</h4>
        @endslot

        @slot('right')
            <form method="POST" action="{!! route('classes.classe.destroy', $classe->id) !!}" accept-charset="UTF-8">
                <input name="_method" value="DELETE" type="hidden">
                {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('classes.classe.index') }}" class="btn btn-primary" title="{{ trans('classes.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('classes.classe.create') }}" class="btn btn-success" title="{{ trans('classes.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>

                    <a href="{{route('classes.classe.edit', $classe->id)}}" class="btn btn-primary" title="{{ trans('classes.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="{{ trans('classes.delete') }}" onclick="return confirm(&quot;{{ trans('classes.confirm_delete') }}&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>
        @endslot

        <dl class="dl-horizontal">
                        <dt>{{ trans('classes.name') }}</dt>
            <dd>{{ $classe->name }}</dd>
            <dt>{{ trans('classes.limit') }}</dt>
            <dd>{{ $classe->limit }}</dd>
            <dt>{{ trans('classes.subpart_id') }}</dt>
            <dd>{{ optional($classe->subpart)->name }}</dd>
            <dt>{{ trans('classes.parent_id') }}</dt>
            <dd>{{ optional($classe->parent)->name }}</dd>

        </dl>
    @endcomponent

@endsection