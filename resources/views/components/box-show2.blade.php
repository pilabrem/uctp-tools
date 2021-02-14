<div class="row">

    <div class="col-xs-12">
        <div class="box box-{{ config('custom.theme_alert') }}  my-box">
            <div class="box-header with-border">

                <span class="pull-left">
                    {{ $left }}
                </span>

                <div class="pull-right">

                    {{ $right }}

                </div>
            </div>

            <div class="box-body">
                {{ $slot }}
            </div>

            <div class="box-footer text-center">
                {{ $slotFooter }}
            </div>
        </div>
    </div>
</div>
