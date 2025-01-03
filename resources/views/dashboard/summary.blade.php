  @extends('layouts.app')

  @section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
      <h1>
          {{__('messages.monthly_summary')}}
      </h1>
      <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> {{__('messages.information')}}</a></li>
          <li class="active">{{__('messages.monthly_activities')}}</li>
      </ol>
  </section>

  <!-- Main content -->
  <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
          <div class="col-xs-12">
              <div class="box">
                  <div class="box-header">
                      <h3 class="box-title">{{__('messages.monthly_activities')}}</h3>

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
                                  <td colspan="3" class="bg-info  ">{{__('messages.loan')}}</td>
                                  <td colspan="6" class="bg-success">{{__('messages.activity')}}</td>
                              </tr>
                              <tr>
                                  <th>{{__('messages.id')}}</th>
                                  <th>{{__('messages.user')}}</th>
                                  <th>{{__('messages.amount')}}</th>
                                  <th>{{__('messages.id')}}</th>
                                  <th>{{__('messages.amount')}}</th>
                                  <th>{{__('messages.due')}}</th>
                                  <th>{{__('messages.total')}}</th>
                                  <th>{{__('messages.user_percent')}}</th>
                                  <th>{{__('messages.earnings')}}</th>
                              </tr>
                              @foreach($loans as $loan)
                              @foreach($loan->activities as $activity)

                              @php
                              $user_percent = $activity->getUserPercent();
                              $user_earnings = round(($user_percent * $activity->earnings ) / 100, 0);
                              @endphp
                              <tr>
                                  <td><a href="{{route('loans.show', $loan)}}"> {{ $loan->id }} </a></td>
                                  <td>{{ $loan->user->name }}</td>
                                  <td>{{ $loan->amount }}</td>
                                  <td><a href="{{route('activities.show', $activity)}}"> {{ $activity->id }} </a></td>
                                  <td>{{ $activity->amount }}</td>
                                  <td>{{ $activity->due }}</td>
                                  <td>{{ $activity->earnings }}</td>
                                  <td>{{ $user_percent }} %</td>
                                  <td>{{ $user_earnings }}</td>
                              </tr>
                              @endforeach
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