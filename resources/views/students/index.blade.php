@extends('layouts.app')

@section('content-header')
    <h1>
        {{ trans('students.model_plural') }}
        <small>Affichage </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class="active"><a href="{{ route('students.student.index') }}">{{ trans('students.model_plural') }}</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-index')
            @slot('left')
                <h4 class="mt-5 mb-5">{{ trans('students.model_plural') }}</h4>
            @endslot

            @slot('right')
                <a href="{{ route('students.student.create') }}" class="btn btn-success" title="{{ trans('students.create') }}">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>
            @endslot

            @if(count($students) == 0)
                <div class="box-body">
                    <h4>{{ trans('students.none_available') }}</h4>
                </div>
            @else
                <div class="box-body">
                    <div class="table-responsive">

                        <table id="students" class="table table-striped table-hover">
                            <thead>
                            <tr>
                                                            <th>{{ trans('students.name') }}</th>
                            <th>{{ trans('students.problem_id') }}</th>


                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($students as $student)
                                <tr>
                                                                <td>{{ $student->name }}</td>
                            <td>{{ optional($student->problem)->name }}</td>


                                    <td>

                                        <form method="POST" action="{!! route('students.student.destroy', $student->id) !!}" accept-charset="UTF-8">
                                            <input name="_method" value="DELETE" type="hidden">
                                            {{ csrf_field() }}

                                            <div class="btn-group btn-group-xs pull-right" role="group">
                                                <a href="{{ route('students.student.show', $student->id ) }}" class="btn btn-info" title="{{ trans('students.show') }}">
                                                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                                </a>
                                                <a href="{{ route('students.student.edit', $student->id) }}" class="btn btn-primary" title="{{ trans('students.edit') }}">
                                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                                </a>

                                                <button type="submit" class="btn btn-danger" title="{{ trans('students.delete') }}" onclick="return confirm(&quot;{{ trans('students.confirm_delete') }}&quot;)">
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
                    {!! $students->render() !!}
                </div>

            @endif
        @endcomponent

@endsection