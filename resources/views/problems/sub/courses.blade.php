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


    {{-- Liste des cours --}}
    @component('components.box-show')

        @slot('left')
            <h4 class="mt-5 mb-5">Cours</h4>
        @endslot

        @slot('right')
            <a href="{{ route('courses.course.create') }}" class="btn btn-success" title="{{ trans('courses.create') }}">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            </a>
        @endslot

        <table id="problems" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Course</th>
                    <th>Config</th>
                    <th>Subpart</th>
                    <th>Class</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($problem->courses as $_course)
                    <tr>
                        <td>{{ $_course->name }}</td>
                        <td>
                            <a href="{{ route('configs.config.create', $_course->id) }}" class="btn btn-success btn-xs"
                                title="{{ trans('configs.create') }}">
                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                            </a>
                        </td>
                        <td></td>
                        <td></td>
                        <td>
                            <form method="POST" action="{!! route('courses.course.destroy', $_course->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                <div class="btn-group btn-group-xs pull-right" role="group">
                                    <a href="{{ route('courses.course.show', $_course->id) }}" class="btn btn-info"
                                        title="{{ trans('courses.show') }}">
                                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                    </a>
                                    <a href="{{ route('courses.course.edit', $_course->id) }}" class="btn btn-primary"
                                        title="{{ trans('courses.edit') }}">
                                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                    </a>

                                    <button type="submit" class="btn btn-danger" title="{{ trans('courses.delete') }}"
                                        onclick="return confirm(&quot;{{ trans('courses.confirm_delete') }}&quot;)">
                                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                    </button>
                                </div>

                            </form>
                        </td>
                    </tr>
                    @foreach ($_course->configs as $_config)
                        <tr>
                            <td></td>
                            <td>{{ $_config->name }}</td>
                            <td>
                                <a href="{{ route('subparts.subpart.create', $_config->id) }}" class="btn btn-success btn-xs"
                                    title="{{ trans('subparts.create') }}">
                                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                </a>
                            </td>
                            <td></td>
                            <td>
                                <form method="POST" action="{!! route('configs.config.destroy', [$_course->id, $_config->id]) !!}" accept-charset="UTF-8">
                                    <input name="_method" value="DELETE" type="hidden">
                                    {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('configs.config.show', [$_course->id, $_config->id]) }}"
                                            class="btn btn-info" title="{{ trans('configs.show') }}">
                                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('configs.config.edit', [$_course->id, $_config->id]) }}"
                                            class="btn btn-primary" title="{{ trans('configs.edit') }}">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="{{ trans('configs.delete') }}"
                                            onclick="return confirm(&quot;{{ trans('configs.confirm_delete') }}&quot;)">
                                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                        </button>
                                    </div>

                                </form>
                            </td>
                        </tr>
                        @foreach ($_config->subparts as $_subpart)
                            <tr>
                                <td></td>
                                <td></td>
                                <td>{{ $_subpart->name }}</td>
                                <td>

                                    <a href="{{ route('classes.classe.create', $_subpart->id) }}"
                                        class="btn btn-success btn-xs" title="{{ trans('classes.create') }}">
                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                    </a>
                                </td>
                                <td>
                                    <form method="POST" action="{!! route('subparts.subpart.destroy', [$_config->id, $_subpart->id]) !!}" accept-charset="UTF-8">
                                        <input name="_method" value="DELETE" type="hidden">
                                        {{ csrf_field() }}

                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                            <a href="{{ route('subparts.subpart.show', [$_config->id, $_subpart->id]) }}"
                                                class="btn btn-info" title="{{ trans('subparts.show') }}">
                                                <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                            </a>
                                            <a href="{{ route('subparts.subpart.edit', [$_config->id, $_subpart->id]) }}"
                                                class="btn btn-primary" title="{{ trans('subparts.edit') }}">
                                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                            </a>

                                            <button type="submit" class="btn btn-danger"
                                                title="{{ trans('subparts.delete') }}"
                                                onclick="return confirm(&quot;{{ trans('subparts.confirm_delete') }}&quot;)">
                                                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                            </button>
                                        </div>

                                    </form>
                                </td>
                            </tr>
                            @foreach ($_subpart->classes as $_class)
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        {{ $_class->name }} ({{ $_class->limit }})
                                        @if (isset($_class->parent))
                                            , parent : {{ optional(optional($_class)->parent)->name }}
                                        @endif
                                        <br>

                                        <br>
                                        <table style="width: 100%;">
                                            <caption>
                                                <span style="font-size: larger; padding-right: 10px;">Possible rooms</span>
                                                <a href="{{ route('class_possible_rooms.class_possible_room.create', $_class->id) }}"
                                                    class="btn btn-success btn-xs"
                                                    title="{{ trans('class_possible_rooms.create') }}">
                                                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                                </a>
                                            </caption>


                                            @if ($_class->possibleRooms->count() > 0)
                                                <tr>
                                                    <th>Room</th>
                                                    <th>Penalty</th>
                                                    <th></th>
                                                </tr>
                                                @foreach ($_class->possibleRooms as $_room)
                                                    <tr>
                                                        <td>{{ optional($_room->room)->id_room }}</td>
                                                        <td>{{ $_room->penalty }}</td>
                                                        <td>
                                                            <a href="{{ route('class_possible_rooms.class_possible_room.show', [$_class->id, $_room->id]) }}"
                                                                class="btn btn-info btn-xs"
                                                                title="{{ trans('class_possible_rooms.show') }}">
                                                                <span class="glyphicon glyphicon-eye-open"
                                                                    aria-hidden="true"></span>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </table>

                                        <br>

                                        <table style="width: 100%;">
                                            <caption>
                                                <span style="font-size: larger; padding-right: 10px;">Possible time slots</span>

                                                <a href="{{ route('class_possible_times.class_possible_time.create', $_class->id) }}"
                                                    class="btn btn-success btn-xs"
                                                    title="{{ trans('class_possible_times.create') }}">
                                                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                                </a>
                                            </caption>
                                            @if ($_class->possibleTimes->count() > 0)
                                                <tr>
                                                    <th>Weeks</th>
                                                    <th>Days</th>
                                                    <th>Start</th>
                                                    <th>End</th>
                                                    <th>Penalty</th>
                                                    <th></th>
                                                </tr>
                                                @foreach ($_class->possibleTimes as $_time)
                                                    <tr>
                                                        <td>{{ implode(', ', $_time->weeks) }}</td>
                                                        <td>{{ $problem->getDays($_time->days) }}</td>
                                                        <td>{{ $problem->getHour(intval($_time->start)) }}</td>
                                                        <td>
                                                            {{ $problem->getHour(intval($_time->start) + intval($_time->length)) }}
                                                        </td>
                                                        <td>{{ $_time->penalty }}</td>
                                                        <td>
                                                            <a href="{{ route('class_possible_times.class_possible_time.show', [$_class->id, $_time->id]) }}"
                                                                class="btn btn-info btn-xs"
                                                                title="{{ trans('class_possible_times.show') }}">
                                                                <span class="glyphicon glyphicon-eye-open"
                                                                    aria-hidden="true"></span>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </table>

                                        <br>
                                        <br>

                                    </td>
                                    <td>
                                        <form method="POST" action="{!! route('classes.classe.destroy', [$_subpart->id, $_class->id]) !!}" accept-charset="UTF-8">
                                            <input name="_method" value="DELETE" type="hidden">
                                            {{ csrf_field() }}

                                            <div class="btn-group btn-group-xs pull-right" role="group">
                                                <a href="{{ route('classes.classe.show', [$_subpart->id, $_class->id]) }}"
                                                    class="btn btn-info" title="{{ trans('classes.show') }}">
                                                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                                </a>
                                                <a href="{{ route('classes.classe.edit', [$_subpart->id, $_class->id]) }}"
                                                    class="btn btn-primary" title="{{ trans('classes.edit') }}">
                                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                                </a>

                                                <button type="submit" class="btn btn-danger"
                                                    title="{{ trans('classes.delete') }}"
                                                    onclick="return confirm(&quot;{{ trans('classes.confirm_delete') }}&quot;)">
                                                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                                </button>
                                            </div>

                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    @endforeach
                @endforeach
            </tbody>
        </table>
    @endcomponent


@endsection
