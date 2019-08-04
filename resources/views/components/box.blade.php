<div class="row">

    <div class="col-xs-12">
        <div class="box box-{{env('THEME_ALERT')}} collapsed-box">
            <div class="box-header with-border">

                <span class="pull-left">
                    {{$left}}
                </span>

                <div class="pull-right">

                    {{$right}}

                </div>
            </div>

            <div class="box-body">
                {{$slot}}
            </div>

        </div>
    </div>
</div>