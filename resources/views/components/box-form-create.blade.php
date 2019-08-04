<div class="row">

    <div class="col-xs-12">
        <div class="box box-{{env('THEME_ALERT')}}">

            <div class="box-header with-border">
                <span class="pull-left">
                    <h4 class="mt-5 mb-5">{{$headerLeft}}</h4>
                </span>
                <div class="btn-group btn-group-sm pull-right" role="group">
                    {{$actions}}
                </div>
            </div>

            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <form method="POST" action="{{$route}}" accept-charset="UTF-8" id="create_form" name="create_form" role="form" class="form-horizontal" enctype="multipart/form-data">

                <div class="box-body">
                    {{ csrf_field() }}
                    {{$slot}}
                </div>

                <div class="box-footer">
                    <input class="btn btn-{{env('THEME_ALERT')}} pull-right" type="submit" value="Enregistrer et continuer">
                </div>

            </form>
        </div>
    </div>
</div>
