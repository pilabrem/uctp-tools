@extends('layouts.app')

@section('content-header')
    <h1>
        {{ __('Problem instance viewer') }}
        <small>Show </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class=""><a
                href="{{ route('problem_view_forms.problem_view_form.index') }}">{{ trans('problem_view_forms.model_plural') }}</a>
        </li>
        <li class="active"><a
                href="{{ route('problem_view_forms.problem_view_form.show', $problemViewForm->id) }}">Problem
                View Form</a></li>
    </ol>
@endsection

@section('content')

    @include('problem_view_forms.sub.overview')

@endsection
