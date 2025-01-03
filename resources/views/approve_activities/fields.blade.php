<!-- Loan id Type Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('loan_id', __('messages.loan')) !!}
    <select class="form-control" id="loan_id" name="loan_id">
        <option>{{__('messages.select_loan')}}</option>
        @foreach($loans as $loan)

        <option value="{{$loan->id}}" data-nextdue="{{count($loan->activities) + 1 }}" data-pending="{{$loan->amount - $loan->activities->sum('amount')}}" @isset ($activity) @if ($activity->loan_id == $loan->id) selected @endif @endisset>
            #{{$loan->id}} - {{$loan->user->name}} - Amount: {{$loan->amount}} - Pending: ({{$loan->amount - $loan->activities->sum('amount')}})
        </option>
        @endforeach
    </select>
    {{--- Form::select('loan_id', $loans,  null, ['class' => 'form-control']) ---}}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('messages.total_amount')) !!}
    {!! Form::text('tot_amount', null, ['class' => 'form-control', 'id' => 'aux_amount', 'readonly' => true]) !!}
</div>

<!-- Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('amount', __('messages.amount')) !!}
    {!! Form::number('amount', null, ['class' => 'form-control', 'id' => 'activyty_amount', 'readonly' => true]) !!}
</div>

<!-- Earnings Field -->
<div class="form-group col-sm-6">
    {!! Form::label('earnings', __('messages.interest')) !!}
    {!! Form::number('earnings', null, ['class' => 'form-control', 'id' => 'activyty_earnings', 'readonly' => true]) !!}
</div>

{{--- Client Earnings Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('client_earnings', 'Client Earnings:') !!}
    {!! Form::textarea('client_earnings', null, ['class' => 'form-control']) !!}
</div>
---}}
<!-- Due Field -->
<div class="form-group col-sm-6">
    {!! Form::label('due', __('messages.due')) !!}
    {!! Form::number('due', null, ['class' => 'form-control', 'id' => 'next-due', 'readonly' => true]) !!}
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
        //today
        defaultDate: moment(),
    })

    $('#loan_id').on('change', function() {

        var nextdue = $("#loan_id option:selected").data('nextdue');
        $('#next-due').val(nextdue);
        $('#aux_amount').attr('readonly', false)
    });

    $('#aux_amount').on('change', function() {

        var pending = $("#loan_id option:selected").data('pending');
        let total = $(this).val();
        let earnings = (2 * pending) / 100;
        let amount = total - earnings;

        $("#activyty_amount").val(amount.toFixed(0));
        $("#activyty_earnings").val(earnings.toFixed(0));

    });
</script>
@endsection

<!-- Activity Type Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('activity_type_id', __('messages.activity_type')) !!}
    {!! Form::select('activity_type_id', $activities, null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('messages.observation')) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    <a href="{!! route('approve-activities.index') !!}" class="btn btn-default">{{__('messages.cancel')}}</a>
    {!! Form::submit(__('messages.save'), ['class' => 'btn btn-primary']) !!}
</div>