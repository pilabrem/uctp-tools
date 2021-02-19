@extends('layouts.app')

@section('content-header')
    <h1>
        {{ __('Problem instance viewer') }}
        <small>List </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class="active"><a
                href="{{ route('problem_view_forms.problem_view_form.index') }}">{{ trans('problem_view_forms.model_plural') }}</a>
        </li>
    </ol>
@endsection

@section('content')

    @component('components.box-index')
        @slot('left')
            <h4 class="mt-5 mb-5">{{ __('Previews instances') }}</h4>
        @endslot

        @slot('right')
            <a href="{{ route('problem_view_forms.problem_view_form.create') }}" class="btn btn-success"
                title="{{ trans('problem_view_forms.create') }}">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            </a>
        @endslot

        @if (count($problemViewForms) == 0)
            <div class="box-body">
                <h4>{{ trans('problem_view_forms.none_available') }}</h4>
            </div>
        @else
            <div class="box-body">
                <div class="table-responsive">

                    <table id="problemViewForms" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>{{ trans('problem_view_forms.problem_instance') }}</th>
                                <th>{{ trans('problem_view_forms.begin_hour') }}</th>
                                <th>{{ trans('problem_view_forms.days') }}</th>


                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($problemViewForms as $problemViewForm)
                                <tr>
                                    <td><a href="{{ asset('storage\\' . $problemViewForm->problem_instance) }}"
                                            target="__blank"> <i class="fa fa-link"></i> Lien</a></td>
                                    <td>{{ $problemViewForm->begin_hour }}</td>
                                    <td>{{ $problemViewForm->days }}</td>


                                    <td>

                                        <form method="POST"
                                            action="{!!  route('problem_view_forms.problem_view_form.destroy', $problemViewForm->id) !!}"
                                            accept-charset="UTF-8">
                                            <input name="_method" value="DELETE" type="hidden">
                                            {{ csrf_field() }}

                                            <div class="btn-group btn-group-xs pull-right" role="group">
                                                <a href="{{ route('problem_view_forms.problem_view_form.show', $problemViewForm->id) }}"
                                                    class="btn btn-info" title="{{ trans('problem_view_forms.show') }}">
                                                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                                </a>
                                                <a href="{{ route('problem_view_forms.problem_view_form.edit', $problemViewForm->id) }}"
                                                    class="btn btn-primary" title="{{ trans('problem_view_forms.edit') }}">
                                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                                </a>

                                                <button type="submit" class="btn btn-danger"
                                                    title="{{ trans('problem_view_forms.delete') }}"
                                                    onclick="return confirm(&quot;{{ trans('problem_view_forms.confirm_delete') }}&quot;)">
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
                {!! $problemViewForms->render() !!}
            </div>

        @endif
    @endcomponent

@endsection
