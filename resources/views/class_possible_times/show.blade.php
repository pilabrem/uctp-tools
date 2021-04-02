@extends('layouts.app')

@section('content-header')
    <h1>
        Class Possible Time
        <small>Détails </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class=""><a href="{{route('class_possible_times.class_possible_time.index')}}">{{ trans('class_possible_times.model_plural') }}</a></li>
        <li class="active"><a href="{{route('class_possible_times.class_possible_time.show', $classPossibleTime->id)}}">Class Possible Time</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-show')

        @slot('left')
            <h4 class="mt-5 mb-5">{{ !empty($title) ? $title : 'Class Possible Time' }}</h4>
        @endslot

        @slot('right')
            <form method="POST" action="{!! route('class_possible_times.class_possible_time.destroy', $classPossibleTime->id) !!}" accept-charset="UTF-8">
                <input name="_method" value="DELETE" type="hidden">
                {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('class_possible_times.class_possible_time.index') }}" class="btn btn-primary" title="{{ trans('class_possible_times.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('class_possible_times.class_possible_time.create') }}" class="btn btn-success" title="{{ trans('class_possible_times.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>

                    <a href="{{route('class_possible_times.class_possible_time.edit', $classPossibleTime->id)}}" class="btn btn-primary" title="{{ trans('class_possible_times.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="{{ trans('class_possible_times.delete') }}" onclick="return confirm(&quot;{{ trans('class_possible_times.confirm_delete') }}&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>
        @endslot

        <dl class="dl-horizontal">
                        <dt>{{ trans('class_possible_times.classe_id') }}</dt>
            <dd>{{ optional($classPossibleTime->classe)->name }}</dd>
            <dt>{{ trans('class_possible_times.days') }}</dt>
            <dd>{{ implode('; ', $classPossibleTime->days) }}</dd>
            <dt>{{ trans('class_possible_times.start') }}</dt>
            <dd>{{ $classPossibleTime->start }}</dd>
            <dt>{{ trans('class_possible_times.length') }}</dt>
            <dd>{{ $classPossibleTime->length }}</dd>
            <dt>{{ trans('class_possible_times.weeks') }}</dt>
            <dd>{{ implode('; ', $classPossibleTime->weeks) }}</dd>
            <dt>{{ trans('class_possible_times.penalty') }}</dt>
            <dd>{{ $classPossibleTime->penalty }}</dd>

        </dl>
    @endcomponent

@endsection