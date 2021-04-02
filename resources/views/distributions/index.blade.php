@extends('layouts.app')

@section('content-header')
    <h1>
        {{ trans('distributions.model_plural') }}
        <small>Affichage </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class="active"><a
                href="{{ route('distributions.distribution.index') }}">{{ trans('distributions.model_plural') }}</a>
        </li>
    </ol>
@endsection

@section('content')

    @component('components.box-index')
        @slot('left')
            <h4 class="mt-5 mb-5">{{ trans('distributions.model_plural') }}</h4>
        @endslot

        @slot('right')
            <a href="{{ route('distributions.distribution.create') }}" class="btn btn-success"
                title="{{ trans('distributions.create') }}">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            </a>
        @endslot

        @if (count($distributions) == 0)
            <div class="box-body">
                <h4>{{ trans('distributions.none_available') }}</h4>
            </div>
        @else
            <div class="box-body">
                <div class="table-responsive">

                    <table id="distributions" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>{{ trans('distributions.type') }}</th>
                                <th>{{ trans('distributions.is_required') }}</th>
                                <th>{{ trans('distributions.penalty') }}</th>
                                <th>{{ trans('distributions.param1') }}</th>
                                <th>{{ trans('distributions.param2') }}</th>
                                <th>{{ trans('distributions.problem_id') }}</th>


                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($distributions as $distribution)
                                <tr>
                                    <td>{{ $distribution->type }}</td>
                                    <td>{{ $distribution->is_required ? 'Oui' : 'Non' }}</td>
                                    <td>{{ $distribution->penalty }}</td>
                                    <td>{{ $distribution->param1 }}</td>
                                    <td>{{ $distribution->param2 }}</td>
                                    <td>{{ optional($distribution->problem)->name }}</td>


                                    <td>

                                        <form method="POST" action="{!! route('distributions.distribution.destroy', $distribution->id) !!}" accept-charset="UTF-8">
                                            <input name="_method" value="DELETE" type="hidden">
                                            {{ csrf_field() }}

                                            <div class="btn-group btn-group-xs pull-right" role="group">
                                                <a href="{{ route('distributions.distribution.show', $distribution->id) }}"
                                                    class="btn btn-info" title="{{ trans('distributions.show') }}">
                                                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                                </a>
                                                <a href="{{ route('distributions.distribution.edit', $distribution->id) }}"
                                                    class="btn btn-primary" title="{{ trans('distributions.edit') }}">
                                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                                </a>

                                                <button type="submit" class="btn btn-danger"
                                                    title="{{ trans('distributions.delete') }}"
                                                    onclick="return confirm(&quot;{{ trans('distributions.confirm_delete') }}&quot;)">
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
                {!! $distributions->render() !!}
            </div>

        @endif
    @endcomponent

@endsection
