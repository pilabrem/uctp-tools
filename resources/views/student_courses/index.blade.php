@extends('layouts.app')

@section('content-header')
    <h1>
        {{ trans('student_courses.model_plural') }}
        <small>Affichage </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class="active"><a href="{{ route('student_courses.student_course.index') }}">{{ trans('student_courses.model_plural') }}</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-index')
            @slot('left')
                <h4 class="mt-5 mb-5">{{ trans('student_courses.model_plural') }}</h4>
            @endslot

            @slot('right')
                <a href="{{ route('student_courses.student_course.create') }}" class="btn btn-success" title="{{ trans('student_courses.create') }}">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>
            @endslot

            @if(count($studentCourses) == 0)
                <div class="box-body">
                    <h4>{{ trans('student_courses.none_available') }}</h4>
                </div>
            @else
                <div class="box-body">
                    <div class="table-responsive">

                        <table id="studentCourses" class="table table-striped table-hover">
                            <thead>
                            <tr>
                                                            <th>{{ trans('student_courses.student_id') }}</th>
                            <th>{{ trans('student_courses.course_id') }}</th>


                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($studentCourses as $studentCourse)
                                <tr>
                                                                <td>{{ optional($studentCourse->student)->name }}</td>
                            <td>{{ optional($studentCourse->course)->name }}</td>


                                    <td>

                                        <form method="POST" action="{!! route('student_courses.student_course.destroy', $studentCourse->id) !!}" accept-charset="UTF-8">
                                            <input name="_method" value="DELETE" type="hidden">
                                            {{ csrf_field() }}

                                            <div class="btn-group btn-group-xs pull-right" role="group">
                                                <a href="{{ route('student_courses.student_course.show', $studentCourse->id ) }}" class="btn btn-info" title="{{ trans('student_courses.show') }}">
                                                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                                </a>
                                                <a href="{{ route('student_courses.student_course.edit', $studentCourse->id) }}" class="btn btn-primary" title="{{ trans('student_courses.edit') }}">
                                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                                </a>

                                                <button type="submit" class="btn btn-danger" title="{{ trans('student_courses.delete') }}" onclick="return confirm(&quot;{{ trans('student_courses.confirm_delete') }}&quot;)">
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
                    {!! $studentCourses->render() !!}
                </div>

            @endif
        @endcomponent

@endsection