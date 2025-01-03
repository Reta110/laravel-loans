@extends('layouts.app') @section('content') @can('advanced')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>{{__('messages.control_panel')}}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> {{__('messages.home')}}</a></li>
        <li class="active">{{__('messages.dashboard')}}</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-xs-12 col-sm-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3> {{ number_format($total_saved,0,",",".") }} </h3>

                    <p>{{__('messages.total_saved')}}</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">&nbsp;</a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-12 col-sm-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{ number_format($total_borrowed,0,",",".") }}<sup style="font-size: 20px"></sup></h3>

                    <p>{{__('messages.total_borrowed')}}</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">&nbsp;</a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-12 col-sm-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{ $user_count }}</h3>

                    <p>{{__('messages.registered_users')}}</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{ route('users.index') }}" class="small-box-footer">{{__('messages.more_info')}} <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-12 col-sm-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3> {{ $total_loans_count }} </h3>

                    <p>{{__('messages.active_loans')}}</p>
                </div>
                <div class="icon">
                    <i class="ion ion-android-contract"></i>
                </div>
                <a href="{{ route('loans.index') }}" class="small-box-footer">{{__('messages.more_info')}} <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        @can('advancedActions')
        <!-- ./col -->
        <!-- ./col -->
        <div class="col-lg-3 col-xs-12 col-sm-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{ number_format($total_bank_account,0,",",".") }}<sup style="font-size: 20px"></sup></h3>

                    <p>{{__('messages.total_mount_bank_account')}}</p>
                </div>
                <div class="icon">
                    <i class="ion ion-android-lock"></i>
                </div>
                <a href="#" class="small-box-footer">&nbsp;</a>
            </div>
        </div>
        <!-- ./col -->

        <!-- ./col -->
        <div class="col-lg-3 col-xs-12 col-sm-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{ number_format($total_bank_account + $earnings,0,",",".") }}<sup style="font-size: 20px"></sup></h3>

                    <p>{{__('messages.total_mount_bank_account_with_interest')}}</p>
                </div>
                <div class="icon">
                    <i class="ion ion-android-lock"></i>
                </div>
                <a href="#" class="small-box-footer">&nbsp;</a>
            </div>
        </div>
        <!-- ./col -->
        @endcan
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
@endcan

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{__('messages.user_information')}}
        <small>{{__('messages.loans_details')}}</small>
    </h1>
</section>

<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">

        <!-- ./col -->
        <div class="col-lg-3 col-xs-12 col-sm-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3> {{ $total_loans }} </h3>

                    <p>{{__('messages.total')}}</p>
                </div>
                <div class="icon">
                    <i class="ion ion-cash"></i>
                </div>
                <a href="{{ route('loans.index') }}" class="small-box-footer">{{__('messages.more_info')}} <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-3 col-xs-12 col-sm-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{ $remaining }}</h3>

                    <p>{{__('messages.remaining')}}</p>
                </div>
                <div class="icon">
                    <i class="ion ion-calculator"></i>
                </div>
                <a href="#" class="small-box-footer">&nbsp;</a>
            </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-3 col-xs-12 col-sm-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{ $total_user_loans_count }}<sup style="font-size: 20px"></sup></h3>

                    <p>{{__('messages.active_loans')}}</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">&nbsp;</a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <!-- /.row -->
    @can('advanced')
    <div class="row">
        <div class="box-header">
            <h2 class="box-title">{{__('messages.endorsed_loans')}}</h2>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
            @if(count($endorses) > 0)
            <table class="table table-condensed">
                <tbody>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>{{__('messages.user')}}</th>
                        <th>{{__('messages.amount')}}</th>
                        <th>{{__('messages.remaining_capital')}}</th>
                        <th class="hidden-xs">{{__('messages.start_at')}}</th>
                        <th class="hidden-xs">{{__('messages.expires_at')}}</th>
                        <th>{{__('messages.actions')}}</th>
                    </tr>
                    @php
                    $amount = 0;
                    @endphp
                    @foreach($endorses as $endorse)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $endorse->user->name }}</td>
                        <td>{{ $endorse->amount }}</td>
                        <td>{{ $endorse->amount - $endorse->activities->sum('amount') }}</td>
                        <td class="hidden-xs">{{ $endorse->date }}</td>
                        <td class="hidden-xs"> {{ $endorse->expires_at }}</td>
                        <td>
                            <a href="{{route('loans.show', $endorse )}}" class='btn btn-default btn-xs'>
                                <i class="glyphicon glyphicon-eye-open"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="col-lg-3 col-xs-12 col-sm-6">
                <p>{{__('messages.no_loans_endorsed')}}</p>
            </div>
            @endif
        </div>
    </div>
    @endcan
</section>
<!-- /.content -->

@endsection