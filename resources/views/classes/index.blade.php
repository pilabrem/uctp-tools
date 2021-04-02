@extends('layouts.app')

@section('content-header')
    <h1>
        {{ trans('classes.model_plural') }}
        <small>Affichage </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class="active"><a href="{{ route('classes.classe.index') }}">{{ trans('classes.model_plural') }}</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-index')
            @slot('left')
                <h4 class="mt-5 mb-5">{{ trans('classes.model_plural') }}</h4>
            @endslot

            @slot('right')
                <a href="{{ route('classes.classe.create') }}" class="btn btn-success" title="{{ trans('classes.create') }}">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>
            @endslot

            @if(count($classes) == 0)
                <div class="box-body">
                    <h4>{{ trans('classes.none_available') }}</h4>
                </div>
            @else
                <div class="box-body">
                    <div class="table-responsive">

                        <table id="classes" class="table table-striped table-hover">
                            <thead>
                            <tr>
                                                            <th>{{ trans('classes.name') }}</th>
                            <th>{{ trans('classes.limit') }}</th>
                            <th>{{ trans('classes.subpart_id') }}</th>
                            <th>{{ trans('classes.parent_id') }}</th>


                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($classes as $classe)
                                <tr>
                                                                <td>{{ $classe->name }}</td>
                            <td>{{ $classe->limit }}</td>
                            <td>{{ optional($classe->subpart)->name }}</td>
                            <td>{{ optional($classe->parent)->name }}</td>


                                    <td>

                                        <form method="POST" action="{!! route('classes.classe.destroy', $classe->id) !!}" accept-charset="UTF-8">
                                            <input name="_method" value="DELETE" type="hidden">
                                            {{ csrf_field() }}

                                            <div class="btn-group btn-group-xs pull-right" role="group">
                                                <a href="{{ route('classes.classe.show', $classe->id ) }}" class="btn btn-info" title="{{ trans('classes.show') }}">
                                                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                                </a>
                                                <a href="{{ route('classes.classe.edit', $classe->id) }}" class="btn btn-primary" title="{{ trans('classes.edit') }}">
                                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                                </a>

                                                <button type="submit" class="btn btn-danger" title="{{ trans('classes.delete') }}" onclick="return confirm(&quot;{{ trans('classes.confirm_delete') }}&quot;)">
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
                    {!! $classes->render() !!}
                </div>

            @endif
        @endcomponent

@endsection