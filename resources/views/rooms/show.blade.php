@extends('layouts.app')

@section('content-header')
    <h1>
        Room
        <small>Détails </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class=""><a href="{{route('rooms.room.index')}}">{{ trans('rooms.model_plural') }}</a></li>
        <li class="active"><a href="{{route('rooms.room.show', $room->id)}}">Room</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-show')

        @slot('left')
            <h4 class="mt-5 mb-5">{{ !empty($title) ? $title : 'Room' }}</h4>
        @endslot

        @slot('right')
            <form method="POST" action="{!! route('rooms.room.destroy', $room->id) !!}" accept-charset="UTF-8">
                <input name="_method" value="DELETE" type="hidden">
                {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('rooms.room.index') }}" class="btn btn-primary" title="{{ trans('rooms.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('rooms.room.create') }}" class="btn btn-success" title="{{ trans('rooms.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>

                    <a href="{{route('rooms.room.edit', $room->id)}}" class="btn btn-primary" title="{{ trans('rooms.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="{{ trans('rooms.delete') }}" onclick="return confirm(&quot;{{ trans('rooms.confirm_delete') }}&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>
        @endslot

        <dl class="dl-horizontal">
                        <dt>{{ trans('rooms.id_room') }}</dt>
            <dd>{{ $room->id_room }}</dd>
            <dt>{{ trans('rooms.capacity') }}</dt>
            <dd>{{ $room->capacity }}</dd>
            <dt>{{ trans('rooms.problem_id') }}</dt>
            <dd>{{ optional($room->problem)->name }}</dd>

        </dl>
    @endcomponent

@endsection