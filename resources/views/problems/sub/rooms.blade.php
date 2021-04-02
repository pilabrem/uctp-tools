@extends('layouts.app')

@section('content-header')
    <h1>
        {{ __('Problem instance viewer') }}
        <small>Show </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class=""><a
                href="{{ route('problem_view_forms.problem_view_form.index') }}">{{ trans('problem_view_forms.model_plural') }}</a>
        </li>
        <li class="active"><a href="{{ route('problem_view_forms.problem_view_form.show', $problem->id) }}">Problem</a>
        </li>
    </ol>
@endsection

@section('content')

    @include('problems.sub.overview')


    {{-- Liste des salles --}}
    @component('components.box-show')

        @slot('left')
            <h4 class="mt-5 mb-5">Salles</h4>
        @endslot

        @slot('right')
            <a href="{{ route('rooms.room.create') }}" class="btn btn-success" title="{{ trans('rooms.create') }}">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            </a>
        @endslot

        <table id="problems" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Salle</th>
                    <th>Capacité</th>
                    <th>Trajets</th>
                    <th>Indisponiblités</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($problem->rooms as $_room)
                    <tr>
                        <td>{{ $_room->id_room }}</td>
                        <td>{{ $_room->capacity }}</td>
                        <td>
                            @foreach ($_room->travels as $_travel)
                                <a href="{{ route('travel.travel.show', [$_room->id, $_travel->id]) }}" class="info_link">
                                    {{ $_travel->travelTo->id_room }} -
                                    {{ intval($_travel->value) * $problem->minutes_per_slot }}mn
                                </a>
                                <br><br>
                            @endforeach

                            <a href="{{ route('travel.travel.create', $_room->id) }}">Nouveau trajet</a>
                        </td>
                        <td>

                            @foreach ($_room->unavailabilities as $_unavailable)
                                <a class="info_link"
                                    href="{{ route('room_unavailables.room_unavailable.show', [$_room->id, $_unavailable->id]) }}">
                                    Semaines:
                                    {{ implode(', ', $_unavailable->weeks) }}
                                    - Jours :
                                    {{ $problem->getDays($_unavailable->days) }}
                                    de
                                    {{ $problem->getHour(intval($_unavailable->start)) }}
                                    à
                                    {{ $problem->getHour(intval($_unavailable->start) + intval($_unavailable->length)) }}
                                </a>
                                <br>
                                <br>
                            @endforeach
                            <a href="{{ route('room_unavailables.room_unavailable.create', $_room->id) }}">Nouvelle
                                indisponibilité</a>
                        </td>
                        <td>
                            <form method="POST" action="{!! route('rooms.room.destroy', $_room->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                <div class="btn-group btn-group-xs pull-right" role="group">
                                    <a href="{{ route('rooms.room.show', $_room->id) }}" class="btn btn-info"
                                        title="{{ trans('rooms.show') }}">
                                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                    </a>
                                    <a href="{{ route('rooms.room.edit', $_room->id) }}" class="btn btn-primary"
                                        title="{{ trans('rooms.edit') }}">
                                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                    </a>

                                    <button type="submit" class="btn btn-danger" title="{{ trans('rooms.delete') }}"
                                        onclick="return confirm(&quot;{{ trans('rooms.confirm_delete') }}&quot;)">
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
