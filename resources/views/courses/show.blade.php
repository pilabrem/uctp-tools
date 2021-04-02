@extends('layouts.app')

@section('content-header')
    <h1>
        Course
        <small>Détails </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class=""><a href="{{route('courses.course.index')}}">{{ trans('courses.model_plural') }}</a></li>
        <li class="active"><a href="{{route('courses.course.show', $course->id)}}">Course</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-show')

        @slot('left')
            <h4 class="mt-5 mb-5">{{ !empty($course->name) ? $course->name : 'Course' }}</h4>
        @endslot

        @slot('right')
            <form method="POST" action="{!! route('courses.course.destroy', $course->id) !!}" accept-charset="UTF-8">
                <input name="_method" value="DELETE" type="hidden">
                {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('courses.course.index') }}" class="btn btn-primary" title="{{ trans('courses.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('courses.course.create') }}" class="btn btn-success" title="{{ trans('courses.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>

                    <a href="{{route('courses.course.edit', $course->id)}}" class="btn btn-primary" title="{{ trans('courses.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="{{ trans('courses.delete') }}" onclick="return confirm(&quot;{{ trans('courses.confirm_delete') }}&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>
        @endslot

        <dl class="dl-horizontal">
                        <dt>{{ trans('courses.name') }}</dt>
            <dd>{{ $course->name }}</dd>
            <dt>{{ trans('courses.problem_id') }}</dt>
            <dd>{{ optional($course->problem)->name }}</dd>

        </dl>
    @endcomponent

@endsection