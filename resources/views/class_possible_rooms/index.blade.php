@extends('layouts.app')

@section('content-header')
    <h1>
        {{ trans('class_possible_rooms.model_plural') }}
        <small>Affichage </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class="active"><a href="{{ route('class_possible_rooms.class_possible_room.index') }}">{{ trans('class_possible_rooms.model_plural') }}</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-index')
            @slot('left')
                <h4 class="mt-5 mb-5">{{ trans('class_possible_rooms.model_plural') }}</h4>
            @endslot

            @slot('right')
                <a href="{{ route('class_possible_rooms.class_possible_room.create') }}" class="btn btn-success" title="{{ trans('class_possible_rooms.create') }}">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>
            @endslot

            @if(count($classPossibleRooms) == 0)
                <div class="box-body">
                    <h4>{{ trans('class_possible_rooms.none_available') }}</h4>
                </div>
            @else
                <div class="box-body">
                    <div class="table-responsive">

                        <table id="classPossibleRooms" class="table table-striped table-hover">
                            <thead>
                            <tr>
                                                            <th>{{ trans('class_possible_rooms.room_id') }}</th>
                            <th>{{ trans('class_possible_rooms.penalty') }}</th>
                            <th>{{ trans('class_possible_rooms.classe_id') }}</th>


                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($classPossibleRooms as $classPossibleRoom)
                                <tr>
                                                                <td>{{ optional($classPossibleRoom->room)->id_room }}</td>
                            <td>{{ $classPossibleRoom->penalty }}</td>
                            <td>{{ optional($classPossibleRoom->classe)->name }}</td>


                                    <td>

                                        <form method="POST" action="{!! route('class_possible_rooms.class_possible_room.destroy', $classPossibleRoom->id) !!}" accept-charset="UTF-8">
                                            <input name="_method" value="DELETE" type="hidden">
                                            {{ csrf_field() }}

                                            <div class="btn-group btn-group-xs pull-right" role="group">
                                                <a href="{{ route('class_possible_rooms.class_possible_room.show', $classPossibleRoom->id ) }}" class="btn btn-info" title="{{ trans('class_possible_rooms.show') }}">
                                                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                                </a>
                                                <a href="{{ route('class_possible_rooms.class_possible_room.edit', $classPossibleRoom->id) }}" class="btn btn-primary" title="{{ trans('class_possible_rooms.edit') }}">
                                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                                </a>

                                                <button type="submit" class="btn btn-danger" title="{{ trans('class_possible_rooms.delete') }}" onclick="return confirm(&quot;{{ trans('class_possible_rooms.confirm_delete') }}&quot;)">
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
                    {!! $classPossibleRooms->render() !!}
                </div>

            @endif
        @endcomponent

@endsection