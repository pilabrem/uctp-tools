<!DOCTYPE html>
<html>

<head>
    @include('layouts.admin.includes.head')

    <style>
        .pagination>li>a,
        .pagination>li>span {
            color: @include('layouts.admin.includes.primary-color'); // use your own color here
        }

        .pagination>.active>a,
        .pagination>.active>a:focus,
        .pagination>.active>a:hover,
        .pagination>.active>span,
        .pagination>.active>span:focus,
        .pagination>.active>span:hover {
            background-color: @include('layouts.admin.includes.primary-color');
            border-color: @include('layouts.admin.includes.primary-color');
        }

    </style>

</head>

<body class="hold-transition {{ config('custom.theme', 'skin-red') }} sidebar-mini fixed">
    <div class="modal fade bs-example-modal-lg" id="document-viewer" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <iframe src="" id="doc-iframe" width="100%" height="500"></iframe>
            </div>
        </div>
    </div>

    <div class="wrapper">

        <header class="main-header">
            @include('layouts.admin.includes.header')
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        @include('layouts.admin.includes.main_side_bar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                @section('content-header')
                    <h1>
                        Tableau de bord
                        <small>Panneau de contrôle </small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="/"><i class="fa fa-dashboard"></i> Tableau de bord</a></li>
                    </ol>
                @show
            </section>

            <!-- Main content -->
            <section class="content">

                @include('layouts.admin.includes.notify')

                @yield('content')
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        {{-- Affiche le pied de page contenant le copyright --}}
        @include('layouts.admin.includes.footer')

        {{-- Affiche une barre de control à droite une fois cliqué sur les trois roues édentées en haut à droite --}}
        @include('layouts.admin.includes.control_side_bar')


    </div>
    <!-- ./wrapper -->



    @include('layouts.admin.includes.js_include')
    @yield('js')

</body>

</html>
