@extends('layouts.app')

@section('content-header')
    <h1>
        {{ trans('distribution_classes.model_plural') }}
        <small>Affichage </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-truck"></i> Dashboard</a></li>
        <li class="active"><a href="{{ route('distribution_classes.distribution_class.index') }}">{{ trans('distribution_classes.model_plural') }}</a></li>
    </ol>
@endsection

@section('content')

    @component('components.box-index')
            @slot('left')
                <h4 class="mt-5 mb-5">{{ trans('distribution_classes.model_plural') }}</h4>
            @endslot

            @slot('right')
                <a href="{{ route('distribution_classes.distribution_class.create') }}" class="btn btn-success" title="{{ trans('distribution_classes.create') }}">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>
            @endslot

            @if(count($distributionClasses) == 0)
                <div class="box-body">
                    <h4>{{ trans('distribution_classes.none_available') }}</h4>
                </div>
            @else
                <div class="box-body">
                    <div class="table-responsive">

                        <table id="distributionClasses" class="table table-striped table-hover">
                            <thead>
                            <tr>
                                                            <th>{{ trans('distribution_classes.classe_id') }}</th>
                            <th>{{ trans('distribution_classes.distribution_id') }}</th>


                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($distributionClasses as $distributionClass)
                                <tr>
                                                                <td>{{ optional($distributionClass->classe)->name }}</td>
                            <td>{{ optional($distributionClass->distribution)->type }}</td>


                                    <td>

                                        <form method="POST" action="{!! route('distribution_classes.distribution_class.destroy', $distributionClass->id) !!}" accept-charset="UTF-8">
                                            <input name="_method" value="DELETE" type="hidden">
                                            {{ csrf_field() }}

                                            <div class="btn-group btn-group-xs pull-right" role="group">
                                                <a href="{{ route('distribution_classes.distribution_class.show', $distributionClass->id ) }}" class="btn btn-info" title="{{ trans('distribution_classes.show') }}">
                                                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                                </a>
                                                <a href="{{ route('distribution_classes.distribution_class.edit', $distributionClass->id) }}" class="btn btn-primary" title="{{ trans('distribution_classes.edit') }}">
                                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                                </a>

                                                <button type="submit" class="btn btn-danger" title="{{ trans('distribution_classes.delete') }}" onclick="return confirm(&quot;{{ trans('distribution_classes.confirm_delete') }}&quot;)">
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
                    {!! $distributionClasses->render() !!}
                </div>

            @endif
        @endcomponent

@endsection