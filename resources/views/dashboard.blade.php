@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3></h3>

                    <p>Problem instances</p>
                </div>
                <div class="icon">
                    <i class="ion ion-email-unread"></i>
                </div>
                <a href="{{ route('problem_view_forms.problem_view_form.index') }}" class="small-box-footer">Plus d'info
                    <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-gray">
                <div class="inner">
                    <h3></h3>

                    <p>Solution instances</p>
                </div>
                <div class="icon">
                    <i class="ion ion-ios-email-outline"></i>
                </div>
                <a href="{{ route('solution_view_forms.solution_view_form.index') }}" class="small-box-footer">Plus d'info
                    <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3></h3>

                    <p>Problems created</p>
                </div>
                <div class="icon">
                    <i class="ion ion-android-add"></i>
                </div>
                <a href="{{ route('problems.problem.index') }}" class="small-box-footer">Plus d'info <i
                        class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-blue">
                <div class="inner">
                    <h3></h3>

                    <p>Problems generated</p>
                </div>
                <div class="icon">
                    {{-- <i class="ion ion-pie-graph"></i> --}}
                    <i class="ion ion-android-sync"></i>
                </div>
                <a href="#" class="small-box-footer">Plus d'info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
@endsection
