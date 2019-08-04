@if(Session::has('success_message'))
    <div class="alert alert-success" style="margin-top: 20px; margin-left: 13.5%; margin-right: 13.5%;">
        <span class="glyphicon glyphicon-ok"></span>
        {!! session('success_message') !!}

        <button type="button" class="close" data-dismiss="alert" aria-label="close">
            <span aria-hidden="true">&times;</span>
        </button>

    </div>
@endif

@if(Session::has('error_message'))
    <div class="alert alert-danger" style="margin-top: 20px; margin-left: 13.5%; margin-right: 13.5%;">
        <span class="glyphicon glyphicon-remove"></span>
        {!! session('error_message') !!}

        <button type="button" class="close" data-dismiss="alert" aria-label="close">
            <span aria-hidden="true">&times;</span>
        </button>

    </div>
@endif