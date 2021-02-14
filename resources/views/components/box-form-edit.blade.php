<div class="row">

    <div class="col-xs-12">
        <div class="box box-{{ config('custom.theme_alert') }}">

            <div class="box-header with-border">
                <span class="pull-left">
                    <h4 class="mt-5 mb-5">{{ $headerLeft }}</h4>
                </span>
                <div class="btn-group btn-group-sm pull-right" role="group">
                    {{ $actions }}
                </div>
            </div>

            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <form method="POST" action="{{ $route }}" accept-charset="UTF-8" id="edit_form" name="edit_form"
                role="form" class="form-horizontal" enctype="multipart/form-data">

                <div class="box-body">
                    {{ csrf_field() }}
                    <input name="_method" type="hidden" value="PUT">
                    {{ $slot }}
                </div>

                <div class="box-footer">
                    <input class="btn btn-{{ config('custom.theme_alert') }}" type="submit" value="Mettre à jour">
                </div>

            </form>
        </div>
    </div>
</div>
