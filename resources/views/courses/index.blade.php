@extends('layouts.app')

@section('content-header')
    <h1>
        {{ trans('courses.model_plural') }}
        <small>Affichage </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class="active"><a href="{{ route('courses.course.index') }}">{{ trans('courses.model_plural') }}</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-index')
            @slot('left')
                <h4 class="mt-5 mb-5">{{ trans('courses.model_plural') }}</h4>
            @endslot

            @slot('right')
                <a href="{{ route('courses.course.create') }}" class="btn btn-success" title="{{ trans('courses.create') }}">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>
            @endslot

            @if(count($courses) == 0)
                <div class="box-body">
                    <h4>{{ trans('courses.none_available') }}</h4>
                </div>
            @else
                <div class="box-body">
                    <div class="table-responsive">

                        <table id="courses" class="table table-striped table-hover">
                            <thead>
                            <tr>
                                                            <th>{{ trans('courses.name') }}</th>
                            <th>{{ trans('courses.problem_id') }}</th>


                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($courses as $course)
                                <tr>
                                                                <td>{{ $course->name }}</td>
                            <td>{{ optional($course->problem)->name }}</td>


                                    <td>

                                        <form method="POST" action="{!! route('courses.course.destroy', $course->id) !!}" accept-charset="UTF-8">
                                            <input name="_method" value="DELETE" type="hidden">
                                            {{ csrf_field() }}

                                            <div class="btn-group btn-group-xs pull-right" role="group">
                                                <a href="{{ route('courses.course.show', $course->id ) }}" class="btn btn-info" title="{{ trans('courses.show') }}">
                                                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                                </a>
                                                <a href="{{ route('courses.course.edit', $course->id) }}" class="btn btn-primary" title="{{ trans('courses.edit') }}">
                                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                                </a>

                                                <button type="submit" class="btn btn-danger" title="{{ trans('courses.delete') }}" onclick="return confirm(&quot;{{ trans('courses.confirm_delete') }}&quot;)">
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
                    {!! $courses->render() !!}
                </div>

            @endif
        @endcomponent

@endsection