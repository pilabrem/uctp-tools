@extends('layouts.app')

@section('content-header')
    <h1>
        {{ trans('problems.model_plural') }}
        <small>Affichage </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class="active"><a href="{{ route('problems.problem.index') }}">{{ trans('problems.model_plural') }}</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-index')
        @slot('left')
            <h4 class="mt-5 mb-5">{{ trans('problems.model_plural') }}</h4>
        @endslot

        @slot('right')
            <a href="{{ route('problems.problem.create') }}" class="btn btn-success" title="{{ trans('problems.create') }}">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            </a>
        @endslot

        @if (count($problems) == 0)
            <div class="box-body">
                <h4>{{ trans('problems.none_available') }}</h4>
            </div>
        @else
            <div class="box-body">
                <div class="table-responsive">

                    <table id="problems" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>{{ trans('problems.name') }}</th>
                                <th>{{ trans('problems.nr_days') }}</th>
                                <th>{{ trans('problems.nr_weeks') }}</th>
                                <th>{{ trans('problems.slots_per_day') }}</th>
                                <th>{{ trans('problems.begin_hour') }}</th>
                                <th>Aléatoire</th>

                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($problems as $problem)
                                <tr>
                                    <td>{{ $problem->name }}</td>
                                    <td>{{ $problem->nr_days }}</td>
                                    <td>{{ $problem->nr_weeks }}</td>
                                    <td>{{ $problem->slots_per_day }}</td>
                                    <td>{{ $problem->begin_hour }}h</td>
                                    <td>{{ $problem->is_random == 1 ? 'Oui' : 'Non' }}</td>

                                    <td>

                                        <form method="POST" action="{!! route('problems.problem.destroy', $problem->id) !!}" accept-charset="UTF-8">
                                            <input name="_method" value="DELETE" type="hidden">
                                            {{ csrf_field() }}

                                            <div class="btn-group btn-group-xs pull-right" role="group">
                                                <a href="{{ route('problems.problem.show', $problem->id) }}"
                                                    class="btn btn-info" title="{{ trans('problems.show') }}">
                                                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                                </a>
                                                <a href="{{ route('problems.problem.edit', $problem->id) }}"
                                                    class="btn btn-primary" title="{{ trans('problems.edit') }}">
                                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                                </a>

                                                <button type="submit" class="btn btn-danger"
                                                    title="{{ trans('problems.delete') }}"
                                                    onclick="return confirm(&quot;{{ trans('problems.confirm_delete') }}&quot;)">
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
                {!! $problems->render() !!}
            </div>

        @endif
    @endcomponent

@endsection
