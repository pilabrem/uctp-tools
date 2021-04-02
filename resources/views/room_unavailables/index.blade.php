@extends('layouts.app')

@section('content-header')
    <h1>
        {{ trans('room_unavailables.model_plural') }}
        <small>Affichage </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class="active"><a href="{{ route('room_unavailables.room_unavailable.index') }}">{{ trans('room_unavailables.model_plural') }}</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-index')
            @slot('left')
                <h4 class="mt-5 mb-5">{{ trans('room_unavailables.model_plural') }}</h4>
            @endslot

            @slot('right')
                <a href="{{ route('room_unavailables.room_unavailable.create') }}" class="btn btn-success" title="{{ trans('room_unavailables.create') }}">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>
            @endslot

            @if(count($roomUnavailables) == 0)
                <div class="box-body">
                    <h4>{{ trans('room_unavailables.none_available') }}</h4>
                </div>
            @else
                <div class="box-body">
                    <div class="table-responsive">

                        <table id="roomUnavailables" class="table table-striped table-hover">
                            <thead>
                            <tr>
                                                            <th>{{ trans('room_unavailables.days') }}</th>
                            <th>{{ trans('room_unavailables.start') }}</th>
                            <th>{{ trans('room_unavailables.length') }}</th>
                            <th>{{ trans('room_unavailables.weeks') }}</th>
                            <th>{{ trans('room_unavailables.room_id') }}</th>


                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roomUnavailables as $roomUnavailable)
                                <tr>
                                                                <td>{{ implode('; ', $roomUnavailable->days) }}</td>
                            <td>{{ $roomUnavailable->start }}</td>
                            <td>{{ $roomUnavailable->length }}</td>
                            <td>{{ implode('; ', $roomUnavailable->weeks) }}</td>
                            <td>{{ optional($roomUnavailable->room)->id_room }}</td>


                                    <td>

                                        <form method="POST" action="{!! route('room_unavailables.room_unavailable.destroy', $roomUnavailable->id) !!}" accept-charset="UTF-8">
                                            <input name="_method" value="DELETE" type="hidden">
                                            {{ csrf_field() }}

                                            <div class="btn-group btn-group-xs pull-right" role="group">
                                                <a href="{{ route('room_unavailables.room_unavailable.show', $roomUnavailable->id ) }}" class="btn btn-info" title="{{ trans('room_unavailables.show') }}">
                                                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                                </a>
                                                <a href="{{ route('room_unavailables.room_unavailable.edit', $roomUnavailable->id) }}" class="btn btn-primary" title="{{ trans('room_unavailables.edit') }}">
                                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                                </a>

                                                <button type="submit" class="btn btn-danger" title="{{ trans('room_unavailables.delete') }}" onclick="return confirm(&quot;{{ trans('room_unavailables.confirm_delete') }}&quot;)">
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
                    {!! $roomUnavailables->render() !!}
                </div>

            @endif
        @endcomponent

@endsection