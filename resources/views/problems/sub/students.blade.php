@extends('layouts.app')

@section('content-header')
    <h1>
        {{ __('Problem instance viewer') }}
        <small>Show </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class=""><a href="{{ route('problems.problem.index') }}">{{ trans('problems.model_plural') }}</a>
        </li>
        <li class="active"><a href="{{ route('problems.problem.show', $problem->id) }}">Problem
                View Form</a></li>
    </ol>
@endsection

@section('content')

    @include('problems.sub.overview')


    {{-- Liste des Etudiants --}}
    @component('components.box-show')

        @slot('left')
            <h4 class="mt-5 mb-5">Etudiants</h4>
        @endslot

        @slot('right')
            <a href="{{ route('students.student.create') }}" class="btn btn-success" title="{{ trans('students.create') }}">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            </a>
        @endslot

        <table id="problems" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Etudiant</th>
                    <th>Cours (class)</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($problem->students as $_student)
                    <tr>
                        <td>{{ $_student->name }}</td>
                        <td>
                            @foreach ($_student->courses as $_ecourse)
                                <a href="{{ route('student_courses.student_course.show', [$_student->id, $_ecourse->id]) }}"
                                    class="link-black">
                                    {{ optional($_ecourse->course)->name }}
                                </a>
                                <br>
                                <br>
                            @endforeach


                            <a href="{{ route('student_courses.student_course.create', $_student->id) }}"
                                class="btn btn-success btn-xs" title="{{ trans('student_courses.create') }}">
                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                            </a>
                        </td>
                        <td>
                            <form method="POST" action="{!! route('students.student.destroy', $_student->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                <div class="btn-group btn-group-xs pull-right" role="group">
                                    <a href="{{ route('students.student.show', $_student->id) }}" class="btn btn-info"
                                        title="{{ trans('students.show') }}">
                                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                    </a>
                                    <a href="{{ route('students.student.edit', $_student->id) }}" class="btn btn-primary"
                                        title="{{ trans('students.edit') }}">
                                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                    </a>

                                    <button type="submit" class="btn btn-danger" title="{{ trans('students.delete') }}"
                                        onclick="return confirm(&quot;{{ trans('students.confirm_delete') }}&quot;)">
                                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                    </button>
                                </div>

                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endcomponent

@endsection
