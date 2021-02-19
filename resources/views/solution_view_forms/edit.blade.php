@extends('layouts.app')

@section('content-header')
    <h1>
        Solution View Form
        <small>Modification </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class=""><a href="{{route('solution_view_forms.solution_view_form.index')}}">{{ trans('solution_view_forms.model_plural') }}</a></li>
        <li class=""><a href="{{route('solution_view_forms.solution_view_form.show', $solutionViewForm->id)}}">Solution View Form</a></li>
        <li class="active"><a href="{{route('solution_view_forms.solution_view_form.edit', $solutionViewForm->id)}}">Modification</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-form-edit')
        @slot('headerLeft') {{ !empty($title) ? $title : 'Solution View Form' }} @endslot

        @slot('actions')
            <a href="{{ route('solution_view_forms.solution_view_form.index') }}" class="btn btn-primary" title="{{ trans('solution_view_forms.show_all') }}">
                <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
            </a>

            <a href="{{ route('solution_view_forms.solution_view_form.create') }}" class="btn btn-success" title="{{ trans('solution_view_forms.create') }}">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            </a>
        @endslot

        @slot('route') {{ route('solution_view_forms.solution_view_form.update', $solutionViewForm->id) }} @endslot

        @include ('solution_view_forms.form', ['solutionViewForm' => $solutionViewForm,])

    @endcomponent

@endsection