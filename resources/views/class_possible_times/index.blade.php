@extends('layouts.app')

@section('content-header')
    <h1>
        {{ trans('class_possible_times.model_plural') }}
        <small>Affichage </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class="active"><a href="{{ route('class_possible_times.class_possible_time.index') }}">{{ trans('class_possible_times.model_plural') }}</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-index')
            @slot('left')
                <h4 class="mt-5 mb-5">{{ trans('class_possible_times.model_plural') }}</h4>
            @endslot

            @slot('right')
                <a href="{{ route('class_possible_times.class_possible_time.create') }}" class="btn btn-success" title="{{ trans('class_possible_times.create') }}">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>
            @endslot

            @if(count($classPossibleTimes) == 0)
                <div class="box-body">
                    <h4>{{ trans('class_possible_times.none_available') }}</h4>
                </div>
            @else
                <div class="box-body">
                    <div class="table-responsive">

                        <table id="classPossibleTimes" class="table table-striped table-hover">
                            <thead>
                            <tr>
                                                            <th>{{ trans('class_possible_times.classe_id') }}</th>
                            <th>{{ trans('class_possible_times.days') }}</th>
                            <th>{{ trans('class_possible_times.start') }}</th>
                            <th>{{ trans('class_possible_times.length') }}</th>
                            <th>{{ trans('class_possible_times.weeks') }}</th>
                            <th>{{ trans('class_possible_times.penalty') }}</th>


                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($classPossibleTimes as $classPossibleTime)
                                <tr>
                                                                <td>{{ optional($classPossibleTime->classe)->name }}</td>
                            <td>{{ implode('; ', $classPossibleTime->days) }}</td>
                            <td>{{ $classPossibleTime->start }}</td>
                            <td>{{ $classPossibleTime->length }}</td>
                            <td>{{ implode('; ', $classPossibleTime->weeks) }}</td>
                            <td>{{ $classPossibleTime->penalty }}</td>


                                    <td>

                                        <form method="POST" action="{!! route('class_possible_times.class_possible_time.destroy', $classPossibleTime->id) !!}" accept-charset="UTF-8">
                                            <input name="_method" value="DELETE" type="hidden">
                                            {{ csrf_field() }}

                                            <div class="btn-group btn-group-xs pull-right" role="group">
                                                <a href="{{ route('class_possible_times.class_possible_time.show', $classPossibleTime->id ) }}" class="btn btn-info" title="{{ trans('class_possible_times.show') }}">
                                                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                                </a>
                                                <a href="{{ route('class_possible_times.class_possible_time.edit', $classPossibleTime->id) }}" class="btn btn-primary" title="{{ trans('class_possible_times.edit') }}">
                                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                                </a>

                                                <button type="submit" class="btn btn-danger" title="{{ trans('class_possible_times.delete') }}" onclick="return confirm(&quot;{{ trans('class_possible_times.confirm_delete') }}&quot;)">
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
                    {!! $classPossibleTimes->render() !!}
                </div>

            @endif
        @endcomponent

@endsection