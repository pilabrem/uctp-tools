@extends('layouts.app')

@section('content-header')
    <h1>
        {{ trans('solution_view_forms.model_plural') }}
        <small>Affichage </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class="active"><a
                href="{{ route('solution_view_forms.solution_view_form.index') }}">{{ trans('solution_view_forms.model_plural') }}</a>
        </li>
    </ol>
@endsection

@section('content')

    @component('components.box-index')
        @slot('left')
            <h4 class="mt-5 mb-5">{{ trans('solution_view_forms.model_plural') }}</h4>
        @endslot

        @slot('right')
            <a href="{{ route('solution_view_forms.solution_view_form.create') }}" class="btn btn-success"
                title="{{ trans('solution_view_forms.create') }}">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            </a>
        @endslot

        @if (count($solutionViewForms) == 0)
            <div class="box-body">
                <h4>{{ trans('solution_view_forms.none_available') }}</h4>
            </div>
        @else
            <div class="box-body">
                <div class="table-responsive">

                    <table id="solutionViewForms" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Instance</th>
                                <th>Début journée</th>
                                <th>Créneau</th>
                                <th>Par jour</th>
                                {{-- <th>Jours</th> --}}
                                <th>Par semestre</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($solutionViewForms as $solutionViewForm)
                                <tr>
                                    <td>
                                        <a href="{{ asset('storage\\' . $solutionViewForm->solution_instance) }}"
                                            target="__blank"> <i class="fa fa-link"></i> Lien</a>
                                    </td>
                                    <td>{{ $solutionViewForm->day_begin }}h</td>
                                    <td>{{ $solutionViewForm->time_slot }}mn</td>
                                    <td>{{ $solutionViewForm->day_time_slots }} créneaux</td>
                                    {{-- <td>{{ $solutionViewForm->week_days }}</td> --}}
                                    <td>{{ $solutionViewForm->semester_weeks }} Semaines</td>


                                    <td>

                                        <form method="POST"
                                            action="{!!  route('solution_view_forms.solution_view_form.destroy', $solutionViewForm->id) !!}"
                                            accept-charset="UTF-8">
                                            <input name="_method" value="DELETE" type="hidden">
                                            {{ csrf_field() }}

                                            <div class="btn-group btn-group-xs pull-right" role="group">
                                                <a href="{{ route('solution_view_forms.solution_view_form.show', $solutionViewForm->id) }}"
                                                    class="btn btn-info" title="{{ trans('solution_view_forms.show') }}">
                                                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                                </a>
                                                <a href="{{ route('solution_view_forms.solution_view_form.edit', $solutionViewForm->id) }}"
                                                    class="btn btn-primary" title="{{ trans('solution_view_forms.edit') }}">
                                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                                </a>

                                                <button type="submit" class="btn btn-danger"
                                                    title="{{ trans('solution_view_forms.delete') }}"
                                                    onclick="return confirm(&quot;{{ trans('solution_view_forms.confirm_delete') }}&quot;)">
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
                {!! $solutionViewForms->render() !!}
            </div>

        @endif
    @endcomponent

@endsection
