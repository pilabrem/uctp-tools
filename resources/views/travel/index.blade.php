@extends('layouts.app')

@section('content-header')
    <h1>
        {{ trans('travel.model_plural') }}
        <small>Affichage </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class="active"><a href="{{ route('travel.travel.index') }}">{{ trans('travel.model_plural') }}</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-index')
            @slot('left')
                <h4 class="mt-5 mb-5">{{ trans('travel.model_plural') }}</h4>
            @endslot

            @slot('right')
                <a href="{{ route('travel.travel.create') }}" class="btn btn-success" title="{{ trans('travel.create') }}">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>
            @endslot

            @if(count($travelObjects) == 0)
                <div class="box-body">
                    <h4>{{ trans('travel.none_available') }}</h4>
                </div>
            @else
                <div class="box-body">
                    <div class="table-responsive">

                        <table id="travelObjects" class="table table-striped table-hover">
                            <thead>
                            <tr>
                                                            <th>{{ trans('travel.room_id') }}</th>
                            <th>{{ trans('travel.value') }}</th>


                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($travelObjects as $travel)
                                <tr>
                                                                <td>{{ optional($travel->room)->id_room }}</td>
                            <td>{{ $travel->value }}</td>


                                    <td>

                                        <form method="POST" action="{!! route('travel.travel.destroy', $travel->id) !!}" accept-charset="UTF-8">
                                            <input name="_method" value="DELETE" type="hidden">
                                            {{ csrf_field() }}

                                            <div class="btn-group btn-group-xs pull-right" role="group">
                                                <a href="{{ route('travel.travel.show', $travel->id ) }}" class="btn btn-info" title="{{ trans('travel.show') }}">
                                                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                                </a>
                                                <a href="{{ route('travel.travel.edit', $travel->id) }}" class="btn btn-primary" title="{{ trans('travel.edit') }}">
                                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                                </a>

                                                <button type="submit" class="btn btn-danger" title="{{ trans('travel.delete') }}" onclick="return confirm(&quot;{{ trans('travel.confirm_delete') }}&quot;)">
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
                    {!! $travelObjects->render() !!}
                </div>

            @endif
        @endcomponent

@endsection