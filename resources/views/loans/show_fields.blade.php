<!-- Client Field -->
<div class="col-md-2 col-xs-6 form-group">
  {!! Form::label('client', __('messages.user')) !!}
  <p>{!! $loan->user->name !!}</p>
</div>

<!-- Amount Field -->
<div class="col-md-2 col-xs-6  form-group">
  {!! Form::label('amount', __('messages.amount')) !!}
  <p>{!! $loan->amount !!}</p>
</div>

<!-- Percent Field -->
<div class="col-md-1 col-xs-4 form-group">
  {!! Form::label('percent', __('messages.percent')) !!}
  <p>{!! $loan->percent !!}</p>
</div>

<!-- Dues Field -->
<div class="col-md-1 col-xs-4  form-group">
  {!! Form::label('dues', __('messages.dues')) !!}
  <p>{!! $loan->dues !!}</p>
</div>

<!-- Finished Field -->
<div class="col-md-2 col-xs-4  form-group">
  {!! Form::label('finished', __('messages.finished')) !!}
  <p>{!! $loan->finished !!}</p>
</div>

<!-- Expires At Field -->
<div class="col-md-2  col-xs-6 form-group">
  {!! Form::label('expires_at', __('messages.expires_at')) !!}
  <p>{!! $loan->expires_at !!}</p>
</div>

<!-- User Id Field -->
<div class="col-md-2 col-xs-6  form-group">
  {!! Form::label('user_id', __('messages.client_endorsed')) !!}
  <p>{!! $loan->client->name !!}</p>
</div>

@can('advanced')
<!-- Client Percents Field -->
<div class="form-group">
  {!! Form::label('client_percents', __('messages.client_percents')) !!}
  <ul>
    @foreach(json_decode($loan->client_percents) as $client)
    <li>{{ $client->name }} - {{ $client->percent }}%</li>
    @endforeach
  </ul>
</div>
@endcan

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">{{__('messages.activities')}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
          <table class="table table-condensed">
            <tbody>
              <tr>
                <th style="width: 10px">#</th>
                <th>{{__('messages.task')}}</th>
                <th>{{__('messages.date')}}</th>
                <th>{{__('messages.amount')}}</th>
                <th>{{__('messages.interest')}}</th>
                <th>{{__('messages.progress')}}</th>
                <th style="width: 40px">Label</th>
              </tr>
              @php
              $amount = 0;
              @endphp
              @forelse($loan->activities as $activity)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>
                  <a href="{{route('activities.show', $activity )}}">{{ $activity->activityType->name }}</a>
                </td>
                <td>{{ $activity->date }}</td>
                <td>{{ $activity->amount }}</td>
                <td>{{ $activity->earnings }}</td>
                <td>
                  @php
                  $amount += $activity->amount;
                  @endphp
                  <div class="progress progress-xs">
                    <div class="progress-bar progress-bar-success" style="width: {{ round(($amount * 100) / $loan->amount)}}%"></div>
                  </div>
                </td>
                <td><span class="badge bg-success">{{ round(($amount * 100) / $loan->amount)}}%</span></td>
              </tr>
              @empty
              <p>No activities</p>
              @endforelse
            </tbody>
          </table>

        </div>

        <!-- /.box-body -->
      </div>
      <div class="col-md-3 col-xs-6 form-group ">
        <p>{{__('messages.total_pending')}}: {{ $loan->amount - $amount }}</p>
        <p>{{__('messages.next_interest_to_pay')}}: {{ round((($loan->amount - $amount) *  $loan->percent) / 100, 2) }}</p>
      </div>

    </div>
  </div>
  </div>