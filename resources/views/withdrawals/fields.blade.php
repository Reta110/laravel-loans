<!-- Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('amount', __('messages.amount')) !!}
    {!! Form::number('amount', null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('messages.observation')) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', __('messages.user')) !!}
    {!! Form::select('user_id', $users, null, ['class' => 'form-control']) !!}
</div>

<!-- Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date', __('messages.date')) !!}
    {!! Form::date('date', null, ['class' => 'form-control','id'=>'date']) !!}
</div>

@section('scripts')
<script type="text/javascript">
    $('#date').datetimepicker({
        format: 'YYYY-MM-DD',
        useCurrent: true,
    })
</script>
@endsection

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('messages.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('withdrawals.index') !!}" class="btn btn-default">{{__('messages.cancel')}}</a>
</div>