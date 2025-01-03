@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{__('messages.pending_users')}}
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> {{__('messages.information')}}</a></li>
        <li class="active">{{__('messages.pending_users')}}</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{__('messages.pending_users')}}</h3>

                    <div class="box-tools">
                        <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>{{__('messages.loan_id')}}</th>
                                <th>{{__('messages.date')}}</th>
                                <th>{{__('messages.user')}}</th>
                                <th>{{__('messages.client')}}</th>
                                <th>{{__('messages.amount')}}</th>
                            </tr>
                            @foreach($loans as $loan)
                            <tr>
                                <td><a href="{{route('loans.show', $loan)}}"> {{ $loan->id }} </a></td>
                                <td>{{ $loan->date }}</td>
                                <td>{{ $loan->user->name }}</td>
                                <td>{{ $loan->client->name }}</td>
                                <td>{{ $loan->amount }}</td>
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