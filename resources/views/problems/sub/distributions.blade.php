@extends('layouts.app')

@section('content-header')
    <h1>
        {{ __('Problem instance viewer') }}
        <small>Show </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class=""><a href="{{ route('problems.problem.index') }}">{{ trans('problems.model_plural') }}</a>
        </li>
        <li class="active"><a href="{{ route('problems.problem.show', $problem->id) }}">Problem
                View Form</a></li>
    </ol>
@endsection

@section('content')

    @include('problems.sub.overview')


    {{-- Liste des contraintes de distribution --}}
    @component('components.box-show')

        @slot('left')
            <h4 class="mt-5 mb-5">Contraintes de distribution</h4>
        @endslot

        @slot('right')
            <a href="{{ route('distributions.distribution.create') }}" class="btn btn-success"
                title="{{ trans('distributions.create') }}">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            </a>
        @endslot

        <table id="problems" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Contrainte</th>
                    <th>Requise</th>
                    <th>Penalités</th>
                    <th>Cours (class)</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($problem->distributions as $_distribution)
                    <tr>
                        <td>
                            {{ $_distribution->type }}
                            @isset($_distribution->param1)
                                ({{ $_distribution->param1 }}
                                @isset($_distribution->param2)
                                    ,{{ $_distribution->param2 }}
                                @endisset
                                )
                            @endisset

                        </td>
                        <td>{{ $_distribution->is_required ? 'Oui' : 'Non' }}</td>
                        </td>
                        <td>
                            {{ $_distribution->penalty }}
                        </td>
                        <td>
                            @foreach ($_distribution->classes as $_class)
                                <a href="{{ route('distribution_classes.distribution_class.show', [$_distribution->id, $_class->classe_id]) }}"
                                    class="link-black">
                                    {{ optional($_class->classe)->name }}
                                </a>
                                <br>
                                <br>
                            @endforeach


                            <a href="{{ route('distribution_classes.distribution_class.create', $_distribution->id) }}"
                                class="btn btn-success btn-xs" title="{{ trans('distribution_classes.create') }}">
                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                            </a>
                        </td>

                        <td>
                            <form method="POST" action="{!! route('distributions.distribution.destroy', $_distribution->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                <div class="btn-group btn-group-xs pull-right" role="group">
                                    <a href="{{ route('distributions.distribution.show', $_distribution->id) }}"
                                        class="btn btn-info" title="{{ trans('distributions.show') }}">
                                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                    </a>
                                    <a href="{{ route('distributions.distribution.edit', $_distribution->id) }}"
                                        class="btn btn-primary" title="{{ trans('distributions.edit') }}">
                                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                    </a>

                                    <button type="submit" class="btn btn-danger" title="{{ trans('distributions.delete') }}"
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
    @endcomponent



@endsection
