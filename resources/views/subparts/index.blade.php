@extends('layouts.app')

@section('content-header')
    <h1>
        {{ trans('subparts.model_plural') }}
        <small>Affichage </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class="active"><a href="{{ route('subparts.subpart.index') }}">{{ trans('subparts.model_plural') }}</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-index')
            @slot('left')
                <h4 class="mt-5 mb-5">{{ trans('subparts.model_plural') }}</h4>
            @endslot

            @slot('right')
                <a href="{{ route('subparts.subpart.create') }}" class="btn btn-success" title="{{ trans('subparts.create') }}">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>
            @endslot

            @if(count($subparts) == 0)
                <div class="box-body">
                    <h4>{{ trans('subparts.none_available') }}</h4>
                </div>
            @else
                <div class="box-body">
                    <div class="table-responsive">

                        <table id="subparts" class="table table-striped table-hover">
                            <thead>
                            <tr>
                                                            <th>{{ trans('subparts.name') }}</th>
                            <th>{{ trans('subparts.config_id') }}</th>


                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($subparts as $subpart)
                                <tr>
                                                                <td>{{ $subpart->name }}</td>
                            <td>{{ optional($subpart->config)->name }}</td>


                                    <td>

                                        <form method="POST" action="{!! route('subparts.subpart.destroy', $subpart->id) !!}" accept-charset="UTF-8">
                                            <input name="_method" value="DELETE" type="hidden">
                                            {{ csrf_field() }}

                                            <div class="btn-group btn-group-xs pull-right" role="group">
                                                <a href="{{ route('subparts.subpart.show', $subpart->id ) }}" class="btn btn-info" title="{{ trans('subparts.show') }}">
                                                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                                </a>
                                                <a href="{{ route('subparts.subpart.edit', $subpart->id) }}" class="btn btn-primary" title="{{ trans('subparts.edit') }}">
                                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                                </a>

                                                <button type="submit" class="btn btn-danger" title="{{ trans('subparts.delete') }}" onclick="return confirm(&quot;{{ trans('subparts.confirm_delete') }}&quot;)">
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
                    {!! $subparts->render() !!}
                </div>

            @endif
        @endcomponent

@endsection