@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{__('messages.monthly')}}
        <small>{{__('messages.payment')}}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i></a>{{__('messages.dashboard')}}</li>
        <li class="active">{{__('messages.monthly_payment')}}</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{__('messages.monthly_payment')}}</h3>

                    <div class="box-tools">
                        <div class="input-group input-group-sm hidden-xs" style="width: 150px;">

                            <a href="{{route('dashboard.pay_pending_activities')}}">
                                <button class="btn btn-success">{{__('messages.pay_all')}}</button>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>{{__('messages.id')}}</th>
                                <th>{{__('messages.user')}}</th>
                                <th>{{__('messages.earned_amount')}}</th>
                            </tr>
                            @foreach($payments as $payment)
                            <tr>
                                <td>{{ $payment['id'] }}</td>
                                <td>{{ $payment['name'] }}</td>
                                <td>{{ $payment['earning_amount'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
<!-- /.content -->

@endsection