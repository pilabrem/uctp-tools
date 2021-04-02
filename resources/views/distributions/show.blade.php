@extends('layouts.app')

@section('content-header')
    <h1>
        Distribution
        <small>Détails </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class=""><a href="{{route('distributions.distribution.index')}}">{{ trans('distributions.model_plural') }}</a></li>
        <li class="active"><a href="{{route('distributions.distribution.show', $distribution->id)}}">Distribution</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-show')

        @slot('left')
            <h4 class="mt-5 mb-5">{{ !empty($title) ? $title : 'Distribution' }}</h4>
        @endslot

        @slot('right')
            <form method="POST" action="{!! route('distributions.distribution.destroy', $distribution->id) !!}" accept-charset="UTF-8">
                <input name="_method" value="DELETE" type="hidden">
                {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('distributions.distribution.index') }}" class="btn btn-primary" title="{{ trans('distributions.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('distributions.distribution.create') }}" class="btn btn-success" title="{{ trans('distributions.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>

                    <a href="{{route('distributions.distribution.edit', $distribution->id)}}" class="btn btn-primary" title="{{ trans('distributions.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="{{ trans('distributions.delete') }}" onclick="return confirm(&quot;{{ trans('distributions.confirm_delete') }}&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>
        @endslot

        <dl class="dl-horizontal">
                        <dt>{{ trans('distributions.type') }}</dt>
            <dd>{{ $distribution->type }}</dd>
            <dt>{{ trans('distributions.is_required') }}</dt>
            <dd>{{ ($distribution->is_required) ? 'Oui' : 'Non' }}</dd>
            <dt>{{ trans('distributions.penalty') }}</dt>
            <dd>{{ $distribution->penalty }}</dd>
            <dt>{{ trans('distributions.param1') }}</dt>
            <dd>{{ $distribution->param1 }}</dd>
            <dt>{{ trans('distributions.param2') }}</dt>
            <dd>{{ $distribution->param2 }}</dd>
            <dt>{{ trans('distributions.problem_id') }}</dt>
            <dd>{{ optional($distribution->problem)->name }}</dd>

        </dl>
    @endcomponent

@endsection