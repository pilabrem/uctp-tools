@extends('layouts.app')

@section('content-header')
    <h1>
        Room Unavailable
        <small>Détails </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class=""><a href="{{route('room_unavailables.room_unavailable.index')}}">{{ trans('room_unavailables.model_plural') }}</a></li>
        <li class="active"><a href="{{route('room_unavailables.room_unavailable.show', $roomUnavailable->id)}}">Room Unavailable</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-show')

        @slot('left')
            <h4 class="mt-5 mb-5">{{ !empty($title) ? $title : 'Room Unavailable' }}</h4>
        @endslot

        @slot('right')
            <form method="POST" action="{!! route('room_unavailables.room_unavailable.destroy', $roomUnavailable->id) !!}" accept-charset="UTF-8">
                <input name="_method" value="DELETE" type="hidden">
                {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('room_unavailables.room_unavailable.index') }}" class="btn btn-primary" title="{{ trans('room_unavailables.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('room_unavailables.room_unavailable.create') }}" class="btn btn-success" title="{{ trans('room_unavailables.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>

                    <a href="{{route('room_unavailables.room_unavailable.edit', $roomUnavailable->id)}}" class="btn btn-primary" title="{{ trans('room_unavailables.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="{{ trans('room_unavailables.delete') }}" onclick="return confirm(&quot;{{ trans('room_unavailables.confirm_delete') }}&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>
        @endslot

        <dl class="dl-horizontal">
                        <dt>{{ trans('room_unavailables.days') }}</dt>
            <dd>{{ implode('; ', $roomUnavailable->days) }}</dd>
            <dt>{{ trans('room_unavailables.start') }}</dt>
            <dd>{{ $roomUnavailable->start }}</dd>
            <dt>{{ trans('room_unavailables.length') }}</dt>
            <dd>{{ $roomUnavailable->length }}</dd>
            <dt>{{ trans('room_unavailables.weeks') }}</dt>
            <dd>{{ implode('; ', $roomUnavailable->weeks) }}</dd>
            <dt>{{ trans('room_unavailables.room_id') }}</dt>
            <dd>{{ optional($roomUnavailable->room)->id_room }}</dd>

        </dl>
    @endcomponent

@endsection