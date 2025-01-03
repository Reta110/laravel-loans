<!-- Id Field -->
<div class="col-md-1 form-group">
    {!! Form::label('id', __('messages.id')) !!}
    <p>{!! $activity->id !!}</p>
</div>

<!-- Amount Field -->
<div class="col-md-2 form-group">
    {!! Form::label('amount', __('messages.amount')) !!}
    <p>{!! $activity->amount !!}</p>
</div>

<!-- Earnings Field -->
<div class="col-md-2 form-group">
    {!! Form::label('earnings', __('messages.earnings')) !!}
    <p>{!! $activity->earnings !!}</p>
</div>

<!-- Due Field -->
<div class="col-md-1 form-group">
    {!! Form::label('due', __('messages.due')) !!}
    <p>{!! $activity->due !!}</p>
</div>

<!-- Date Field -->
<div class="col-md-2 form-group">
    {!! Form::label('date', __('messages.date')) !!}
    <p>{!! $activity->date !!}</p>
</div>

<!-- Activity Type Id Field -->
<div class="col-md-2 form-group">
    {!! Form::label('activity_type_id',__('messages.activity_type')) !!}
    <p>{!! $activity->activityType->name !!}</p>
</div>

<!-- Observation Field -->
<div class="col-md-2 form-group">
    {!! Form::label('name', __('messages.observation')) !!}
    <p>{!! $activity->name !!}</p>
</div>

@can('advanced')
<!-- Client Percents Field -->
<div class="col-md-12 form-group">
    {!! Form::label('client_percents', __('messages.client_percents')) !!}
    <ul>
        @foreach(json_decode($activity->client_earnings) as $client)
        <li>{{ $client->name }}: {{ $client->earning_amount }} ({{ $client->percent }}%)</li>
        @endforeach
    </ul>
</div>
@endcan