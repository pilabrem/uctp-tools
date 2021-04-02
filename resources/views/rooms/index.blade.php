@extends('layouts.app')

@section('content-header')
    <h1>
        {{ trans('rooms.model_plural') }}
        <small>Affichage </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class="active"><a href="{{ route('rooms.room.index') }}">{{ trans('rooms.model_plural') }}</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-index')
            @slot('left')
                <h4 class="mt-5 mb-5">{{ trans('rooms.model_plural') }}</h4>
            @endslot

            @slot('right')
                <a href="{{ route('rooms.room.create') }}" class="btn btn-success" title="{{ trans('rooms.create') }}">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>
            @endslot

            @if(count($rooms) == 0)
                <div class="box-body">
                    <h4>{{ trans('rooms.none_available') }}</h4>
                </div>
            @else
                <div class="box-body">
                    <div class="table-responsive">

                        <table id="rooms" class="table table-striped table-hover">
                            <thead>
                            <tr>
                                                            <th>{{ trans('rooms.id_room') }}</th>
                            <th>{{ trans('rooms.capacity') }}</th>
                            <th>{{ trans('rooms.problem_id') }}</th>


                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rooms as $room)
                                <tr>
                                                                <td>{{ $room->id_room }}</td>
                            <td>{{ $room->capacity }}</td>
                            <td>{{ optional($room->problem)->name }}</td>


                                    <td>

                                        <form method="POST" action="{!! route('rooms.room.destroy', $room->id) !!}" accept-charset="UTF-8">
                                            <input name="_method" value="DELETE" type="hidden">
                                            {{ csrf_field() }}

                                            <div class="btn-group btn-group-xs pull-right" role="group">
                                                <a href="{{ route('rooms.room.show', $room->id ) }}" class="btn btn-info" title="{{ trans('rooms.show') }}">
                                                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                                </a>
                                                <a href="{{ route('rooms.room.edit', $room->id) }}" class="btn btn-primary" title="{{ trans('rooms.edit') }}">
                                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                                </a>

                                                <button type="submit" class="btn btn-danger" title="{{ trans('rooms.delete') }}" onclick="return confirm(&quot;{{ trans('rooms.confirm_delete') }}&quot;)">
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
                    {!! $rooms->render() !!}
                </div>

            @endif
        @endcomponent

@endsection