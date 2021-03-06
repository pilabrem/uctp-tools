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

            {{ $slot }}
        </div>
    </div>
</div>
