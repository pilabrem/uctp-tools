@extends('layouts.app')

@section('content-header')
    <h1>
        Student Course
        <small>Détails </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class=""><a href="{{route('student_courses.student_course.index')}}">{{ trans('student_courses.model_plural') }}</a></li>
        <li class="active"><a href="{{route('student_courses.student_course.show', $studentCourse->id)}}">Student Course</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-show')

        @slot('left')
            <h4 class="mt-5 mb-5">{{ !empty($title) ? $title : 'Student Course' }}</h4>
        @endslot

        @slot('right')
            <form method="POST" action="{!! route('student_courses.student_course.destroy', $studentCourse->id) !!}" accept-charset="UTF-8">
                <input name="_method" value="DELETE" type="hidden">
                {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('student_courses.student_course.index') }}" class="btn btn-primary" title="{{ trans('student_courses.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('student_courses.student_course.create') }}" class="btn btn-success" title="{{ trans('student_courses.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>

                    <a href="{{route('student_courses.student_course.edit', $studentCourse->id)}}" class="btn btn-primary" title="{{ trans('student_courses.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="{{ trans('student_courses.delete') }}" onclick="return confirm(&quot;{{ trans('student_courses.confirm_delete') }}&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>
        @endslot

        <dl class="dl-horizontal">
                        <dt>{{ trans('student_courses.student_id') }}</dt>
            <dd>{{ optional($studentCourse->student)->name }}</dd>
            <dt>{{ trans('student_courses.course_id') }}</dt>
            <dd>{{ optional($studentCourse->course)->name }}</dd>

        </dl>
    @endcomponent

@endsection