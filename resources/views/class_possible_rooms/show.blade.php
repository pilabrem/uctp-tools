@extends('layouts.app')

@section('content-header')
    <h1>
        Class Possible Room
        <small>Détails </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class=""><a href="{{route('class_possible_rooms.class_possible_room.index')}}">{{ trans('class_possible_rooms.model_plural') }}</a></li>
        <li class="active"><a href="{{route('class_possible_rooms.class_possible_room.show', $classPossibleRoom->id)}}">Class Possible Room</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-show')

        @slot('left')
            <h4 class="mt-5 mb-5">{{ !empty($title) ? $title : 'Class Possible Room' }}</h4>
        @endslot

        @slot('right')
            <form method="POST" action="{!! route('class_possible_rooms.class_possible_room.destroy', $classPossibleRoom->id) !!}" accept-charset="UTF-8">
                <input name="_method" value="DELETE" type="hidden">
                {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('class_possible_rooms.class_possible_room.index') }}" class="btn btn-primary" title="{{ trans('class_possible_rooms.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('class_possible_rooms.class_possible_room.create') }}" class="btn btn-success" title="{{ trans('class_possible_rooms.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>

                    <a href="{{route('class_possible_rooms.class_possible_room.edit', $classPossibleRoom->id)}}" class="btn btn-primary" title="{{ trans('class_possible_rooms.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="{{ trans('class_possible_rooms.delete') }}" onclick="return confirm(&quot;{{ trans('class_possible_rooms.confirm_delete') }}&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>
        @endslot

        <dl class="dl-horizontal">
                        <dt>{{ trans('class_possible_rooms.room_id') }}</dt>
            <dd>{{ optional($classPossibleRoom->room)->id_room }}</dd>
            <dt>{{ trans('class_possible_rooms.penalty') }}</dt>
            <dd>{{ $classPossibleRoom->penalty }}</dd>
            <dt>{{ trans('class_possible_rooms.classe_id') }}</dt>
            <dd>{{ optional($classPossibleRoom->classe)->name }}</dd>

        </dl>
    @endcomponent

@endsection