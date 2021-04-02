@extends('layouts.app')

@section('content-header')
    <h1>
        Travel
        <small>Détails </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class=""><a href="{{ route('travel.travel.index') }}">{{ trans('travel.model_plural') }}</a></li>
        <li class="active"><a href="{{ route('travel.travel.show', $travel->id) }}">Travel</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-show')

        @slot('left')
            <h4 class="mt-5 mb-5">{{ !empty($title) ? $title : 'Travel' }}</h4>
        @endslot

        @slot('right')
            <form method="POST" action="{!! route('travel.travel.destroy', $travel->id) !!}" accept-charset="UTF-8">
                <input name="_method" value="DELETE" type="hidden">
                {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('travel.travel.index') }}" class="btn btn-primary" title="{{ trans('travel.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('travel.travel.create') }}" class="btn btn-success" title="{{ trans('travel.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('travel.travel.edit', $travel->id) }}" class="btn btn-primary"
                        title="{{ trans('travel.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="{{ trans('travel.delete') }}"
                        onclick="return confirm(&quot;{{ trans('travel.confirm_delete') }}&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>
        @endslot

        <dl class="dl-horizontal">
            <dt>{{ trans('travel.room_id') }}</dt>
            <dd>{{ optional($travel->travelTo)->id_room }}</dd>
            <dt>{{ trans('travel.value') }}</dt>
            <dd>{{ $travel->value }}</dd>

        </dl>
    @endcomponent

@endsection
