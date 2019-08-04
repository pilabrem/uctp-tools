<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <div class="content-justify-center" style="text-align: center; padding-top: 5px;">
            <img src='' class="img img-fluid" alt="" style="width: 95%; border-radius: 5px;">
        </div>
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">NAVIGATION</li>

            <li class="{{Route::is('dashboard')?'active':null}}">
                <a href="{{route('dashboard')}}">
                    <i class="fa fa-dashboard"></i> <span>Acceuil</span>
                </a>
            </li>

            {{--
            @can('afficher donnees')
            <li class="{{Route::is('d_homologations.d_homologation.*')?'active':null}}">
                <a href="{{route('d_homologations.d_homologation.index')}}">
                    <i class="fa fa-file-text"></i> <span>Demandes d'homologation</span>
                </a>
            </li>
            @endcan
            --}}

            {{--
            <li class="">
                <a href="">
                    <i class="fa fa-road"></i> <span>Trajets</span>
                </a>
            </li>

             <li class="treeview active">
                <a href="#">
                    <i class="fa fa-truck"></i> <span>Voyages</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="">
                        <a href=""><i class="fa fa-circle-o"></i> Tous</a></li>
                    <li class=""><a href=""><i class="fa fa-circle"></i> À venir</a></li>
                    <li class=""><a href=""><i class="fa fa-circle"></i> Encours</a></li>
                    <li class=""><a href=""><i class="fa fa-check-circle"></i> Terminés</a></li>
                </ul>
            </li>
            --}}

            @include('admin.menu')

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
