@extends('layouts.app')

@section('content-header')
    <h1>
        Distribution Class
        <small>Détails </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class=""><a href="{{route('distribution_classes.distribution_class.index')}}">{{ trans('distribution_classes.model_plural') }}</a></li>
        <li class="active"><a href="{{route('distribution_classes.distribution_class.show', $distributionClass->id)}}">Distribution Class</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-show')

        @slot('left')
            <h4 class="mt-5 mb-5">{{ !empty($title) ? $title : 'Distribution Class' }}</h4>
        @endslot

        @slot('right')
            <form method="POST" action="{!! route('distribution_classes.distribution_class.destroy', $distributionClass->id) !!}" accept-charset="UTF-8">
                <input name="_method" value="DELETE" type="hidden">
                {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('distribution_classes.distribution_class.index') }}" class="btn btn-primary" title="{{ trans('distribution_classes.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('distribution_classes.distribution_class.create') }}" class="btn btn-success" title="{{ trans('distribution_classes.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>

                    <a href="{{route('distribution_classes.distribution_class.edit', $distributionClass->id)}}" class="btn btn-primary" title="{{ trans('distribution_classes.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="{{ trans('distribution_classes.delete') }}" onclick="return confirm(&quot;{{ trans('distribution_classes.confirm_delete') }}&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>
        @endslot

        <dl class="dl-horizontal">
                        <dt>{{ trans('distribution_classes.classe_id') }}</dt>
            <dd>{{ optional($distributionClass->classe)->name }}</dd>
            <dt>{{ trans('distribution_classes.distribution_id') }}</dt>
            <dd>{{ optional($distributionClass->distribution)->type }}</dd>

        </dl>
    @endcomponent

@endsection