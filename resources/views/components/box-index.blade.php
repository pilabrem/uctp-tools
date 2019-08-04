<div class="row">

    <div class="col-xs-12">
        <div class="box box-{{env('THEME_ALERT')}}">
            <div class="box-header with-border">

                <span class="pull-left">
                    {{$left}}
                </span>

                <div class="btn-group btn-group-sm pull-right" role="group">
                    {{$right}}
                </div>
                   
            </div>

            {{$slot}}
        </div>
    </div>
</div>