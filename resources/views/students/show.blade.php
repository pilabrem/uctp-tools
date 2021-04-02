@extends('layouts.app')

@section('content-header')
    <h1>
        Student
        <small>Détails </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class=""><a href="{{route('students.student.index')}}">{{ trans('students.model_plural') }}</a></li>
        <li class="active"><a href="{{route('students.student.show', $student->id)}}">Student</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-show')

        @slot('left')
            <h4 class="mt-5 mb-5">{{ !empty($student->name) ? $student->name : 'Student' }}</h4>
        @endslot

        @slot('right')
            <form method="POST" action="{!! route('students.student.destroy', $student->id) !!}" accept-charset="UTF-8">
                <input name="_method" value="DELETE" type="hidden">
                {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('students.student.index') }}" class="btn btn-primary" title="{{ trans('students.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('students.student.create') }}" class="btn btn-success" title="{{ trans('students.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>

                    <a href="{{route('students.student.edit', $student->id)}}" class="btn btn-primary" title="{{ trans('students.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="{{ trans('students.delete') }}" onclick="return confirm(&quot;{{ trans('students.confirm_delete') }}&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>
        @endslot

        <dl class="dl-horizontal">
                        <dt>{{ trans('students.name') }}</dt>
            <dd>{{ $student->name }}</dd>
            <dt>{{ trans('students.problem_id') }}</dt>
            <dd>{{ optional($student->problem)->name }}</dd>

        </dl>
    @endcomponent

@endsection