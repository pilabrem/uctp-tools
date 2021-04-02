@extends('layouts.app')

@section('content-header')
    <h1>
        {{ trans('configs.model_plural') }}
        <small>Affichage </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class="active"><a href="{{ route('configs.config.index') }}">{{ trans('configs.model_plural') }}</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-index')
            @slot('left')
                <h4 class="mt-5 mb-5">{{ trans('configs.model_plural') }}</h4>
            @endslot

            @slot('right')
                <a href="{{ route('configs.config.create') }}" class="btn btn-success" title="{{ trans('configs.create') }}">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>
            @endslot

            @if(count($configs) == 0)
                <div class="box-body">
                    <h4>{{ trans('configs.none_available') }}</h4>
                </div>
            @else
                <div class="box-body">
                    <div class="table-responsive">

                        <table id="configs" class="table table-striped table-hover">
                            <thead>
                            <tr>
                                                            <th>{{ trans('configs.name') }}</th>
                            <th>{{ trans('configs.course_id') }}</th>


                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($configs as $config)
                                <tr>
                                                                <td>{{ $config->name }}</td>
                            <td>{{ optional($config->course)->name }}</td>


                                    <td>

                                        <form method="POST" action="{!! route('configs.config.destroy', $config->id) !!}" accept-charset="UTF-8">
                                            <input name="_method" value="DELETE" type="hidden">
                                            {{ csrf_field() }}

                                            <div class="btn-group btn-group-xs pull-right" role="group">
                                                <a href="{{ route('configs.config.show', $config->id ) }}" class="btn btn-info" title="{{ trans('configs.show') }}">
                                                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                                </a>
                                                <a href="{{ route('configs.config.edit', $config->id) }}" class="btn btn-primary" title="{{ trans('configs.edit') }}">
                                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                                </a>

                                                <button type="submit" class="btn btn-danger" title="{{ trans('configs.delete') }}" onclick="return confirm(&quot;{{ trans('configs.confirm_delete') }}&quot;)">
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
                    {!! $configs->render() !!}
                </div>

            @endif
        @endcomponent

@endsection