@extends('layouts.app')

@section('content-header')
    <h1>
        {{ __('Problem instance viewer') }}
        <small>Edit </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class=""><a
                href="{{ route('problem_view_forms.problem_view_form.index') }}">{{ trans('problem_view_forms.model_plural') }}</a>
        </li>
        <li class=""><a href="{{ route('problem_view_forms.problem_view_form.show', $problemViewForm->id) }}">Problem View
                Form</a></li>
        <li class="active"><a
                href="{{ route('problem_view_forms.problem_view_form.edit', $problemViewForm->id) }}">Modification</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-form-edit')
        @slot('headerLeft') {{ !empty($title) ? $title : 'Problem View Form' }} @endslot

        @slot('actions')
            <a href="{{ route('problem_view_forms.problem_view_form.index') }}" class="btn btn-primary"
                title="{{ trans('problem_view_forms.show_all') }}">
                <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
            </a>

            <a href="{{ route('problem_view_forms.problem_view_form.create') }}" class="btn btn-success"
                title="{{ trans('problem_view_forms.create') }}">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            </a>
        @endslot

        @slot('route') {{ route('problem_view_forms.problem_view_form.update', $problemViewForm->id) }} @endslot

        @include ('problem_view_forms.form', ['problemViewForm' => $problemViewForm,])

    @endcomponent

@endsection
