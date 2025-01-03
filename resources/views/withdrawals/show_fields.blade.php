<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('messages.id')) !!}
    <p>{!! $withdrawal->id !!}</p>
</div>

<!-- Observation Field -->
<div class="form-group">
    {!! Form::label('name', __('messages.observation')) !!}
    <p>{!! $withdrawal->name !!}</p>
</div>

<!-- Amount Field -->
<div class="form-group">
    {!! Form::label('amount', __('messages.amount')) !!}
    <p>{!! $withdrawal->amount !!}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', __('messages.user')) !!}
    <p>{!! $withdrawal->user->name !!}</p>
</div>