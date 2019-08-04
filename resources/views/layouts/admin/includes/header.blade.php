
<!-- Logo -->
<a href="{{route('dashboard')}}" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>{{config('custom.app_name_short')}}</b></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg" style="text-align:left">
            <img src="{{asset('logo.png')}}" alt="logo de alink" height="40" width="40" class="img-circle"
            style="margin-right: 25px; margin-bottom: 3px;">
        {{config('custom.app_name')}}
    </span>
</a>
<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>

    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

            {{--Mettre les autres actions comme l'accès aux notifications ici--}}
            {{--!!Fin--}}

            <!-- User Account: style can be found in dropdown.less -->
            @if(auth()->guest())
                <li><a href="{{ url('/login') }}">Connexion</a></li>
                {{-- <li><a href="{{ url('/register') }}">Inscription</a></li> --}}
            @else
                <li>
                    <a href="">
                        <i class="fa fa-user-o"></i> {{auth()->user()->name}}
                    </a>
                </li>
                <li>
                    <form action="{{route('logout')}}" method="post">
                        {{csrf_field()}}
                        <button type="submit" class="btn btn-default" style="margin-top: 7px; margin-right: 7px; margin-left: 7px;">Se déconnecter</button>
                    </form>
                </li>
            @endif

            <!-- Control Sidebar Toggle Button -->
            {{--<li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
            </li>--}}
        </ul>
    </div>
</nav>
