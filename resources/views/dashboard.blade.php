@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>25</h3>

                    <p>Nouvelles demandes</p>
                </div>
                <div class="icon">
                    <i class="ion ion-email-unread"></i>
                </div>
                <a href="#" class="small-box-footer">Plus d'info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-gray">
                <div class="inner">
                    <h3>3000</h3>

                    <p>Encours de vérification</p>
                </div>
                <div class="icon">
                    <i class="ion ion-ios-email-outline"></i>
                </div>
                <a href="#" class="small-box-footer">Plus d'info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>1558</h3>

                    <p>Encours d'analyse</p>
                </div>
                <div class="icon">
                    <i class="ion ion-android-sync"></i>
                </div>
                <a href="" class="small-box-footer">Plus d'info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-blue">
                <div class="inner">
                    <h3>2888</h3>

                    <p>Encours de validation</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">Plus d'info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
@endsection
