
{{--Affiche les messages d'erreurs et de succès de retour--}}

@if(Session::has('success_message'))
    <div class="alert alert-success" role="alert">
        <span class="glyphicon glyphicon-ok"> </span>
        {!! session('success_message') !!}

        <button type="button" class="close" data-dismiss="alert" aria-label="close">
            <span aria-hidden="true">&times;</span>
        </button>

    </div>
@endif

@if(Session::has('error_message'))
    <div class="alert alert-error alert-danger" role="alert">
        <span class="glyphicon glyphicon-remove"> </span>
        {!! session('error_message') !!}

        <button type="button" class="close" data-dismiss="alert" aria-label="close">
            <span aria-hidden="true">&times;</span>
        </button>

    </div>
@endif
