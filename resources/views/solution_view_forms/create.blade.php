@extends('layouts.app')

@section('content-header')
    <h1>
        Solution View Form
        <small>Nouveau </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class=""><a href="{{route('solution_view_forms.solution_view_form.index')}}">{{ trans('solution_view_forms.model_plural') }}</a></li>
        <li class="active"><a href="{{route('solution_view_forms.solution_view_form.create')}}">Nouveau</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-form-create')
        @slot('headerLeft') {{ trans('solution_view_forms.create') }} @endslot

        @slot('actions')
            <a href="{{ route('solution_view_forms.solution_view_form.index') }}" class="btn btn-primary" title="{{ trans('solution_view_forms.show_all') }}">
                <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
            </a>
        @endslot

        @slot('route') {{ route('solution_view_forms.solution_view_form.store') }} @endslot

        @include ('solution_view_forms.form', ['solutionViewForm' => null,])

    @endcomponent

@endsection


