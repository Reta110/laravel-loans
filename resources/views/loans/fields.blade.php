<!-- Client Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', __('messages.user')) !!}
    {!! Form::select('user_id', $users, null, ['class' => 'form-control']) !!}
</div>

<!-- Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('amount', __('messages.amount')) !!}
    {!! Form::number('amount', null, ['class' => 'form-control']) !!}
</div>

<!-- Percent Field -->
<div class="form-group col-sm-6">
    {!! Form::label('percent', __('messages.percent')) !!}
    {!! Form::number('percent', 2, ['class' => 'form-control']) !!}
</div>

<!-- Dues Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dues', __('messages.dues')) !!}
    {!! Form::number('dues', 6, ['class' => 'form-control']) !!}
</div>

<!-- date -->
<div class="form-group col-sm-6">
    {!! Form::label('date', __('messages.date')) !!}
    {!! Form::date('date', null, ['class' => 'form-control','id'=>'date']) !!}
</div>

<!-- Expires At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('expires_at', __('messages.expires_at')) !!}
    {!! Form::date('expires_at', null, ['class' => 'form-control','id'=>'expires_at']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('client_id', __('messages.client_endorsed')) !!}
    {!! Form::select('client_id', $clients, null, ['class' => 'form-control']) !!}
</div>

<!-- Observation Field -->
<div class="form-group col-sm-6">
    {!! Form::label('observation', __('messages.observation')) !!}
    {!! Form::text('observation', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('messages.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('loans.index') !!}" class="btn btn-default">{{__('messages.cancel')}}</a>
</div>

@section('scripts')
<script type="text/javascript">
    $('#date').datetimepicker({
        format: 'YYYY-MM-DD',
        useCurrent: true
    })
</script>

<script type="text/javascript">
    $('#expires_at').datetimepicker({
        format: 'YYYY-MM-DD',
        useCurrent: true
    })
</script>
@endsection