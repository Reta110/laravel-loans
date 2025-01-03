@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1 class="pull-left">{{__('messages.payment_calculator')}}</h1>
</section>
<div class="content">
    <div class="clearfix"></div>

    @include('flash::message')

    <div class="clearfix"></div>
    <div class="box box-primary">
        <div class="box-body">

            <!-- Dues Field -->
            <div class="form-group col-sm-3">
                {!! Form::label('amount', __('messages.amount')) !!}
                {!! Form::number('amount', 1000000, ['class' => 'form-control', 'id' => 'payment_amount']) !!}
            </div>

            <!-- Dues Field -->
            <div class="form-group col-sm-3">
                {!! Form::label('dues', __('messages.dues')) !!}
                {!! Form::number('dues', 1, ['class' => 'form-control', 'id' => 'payment_dues', 'min' => 1]) !!}
            </div>

            <!-- Date Field -->
            <div class="form-group col-sm-3">
                {!! Form::label('date', __('messages.starting_at')) !!}
                {!! Form::date('date', null, ['class' => 'form-control','id'=>'date']) !!}
            </div>

            <!-- Rate -->
            <div class="form-group col-sm-3">
                {!! Form::label('rate', __('messages.rate')) !!}
                {!! Form::text('rate', '2% mensual', ['class' => 'form-control', 'id' => 'rate', 'disabled' => true]) !!}
            </div>

            <!-- Calculates -->
            <div class="form-group col-sm-12">
                {!! Form::submit(__('messages.calculate'), ['class' => 'btn btn-primary', 'id' => 'calculate-payments']) !!}
            </div>
        </div>
    </div>

    <div class="clearfix"></div>
    <div class="box box-primary">
        <div class="box-body">
            <table class="table table-striped table-bordered'">
                <thead>
                    <tr>
                        <th>{{__('messages.dues')}}</th>
                        <th>{{__('messages.date')}}</th>
                        <th>{{__('messages.debt_payment')}}</th>
                        <th>{{__('messages.interest')}}</th>
                        <th>{{__('messages.total_payment')}}</th>
                        <th>{{__('messages.pending')}}</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>

</div>

@section('scripts')
<script type="text/javascript">
    $('#date').datetimepicker({
        format: 'YYYY-MM-DD',
        useCurrent: true,
        //today
        defaultDate: moment(),
    })

    $('#calculate-payments').on('click', function() {
        let amount = $('#payment_amount').val();
        let dues = $('#payment_dues').val();

        if (amount > 0 && dues > 0) {

            $('.table tbody').html('');

            let date = moment($('#date').val()).add(1, 'month');

            let debt_payment = Math.round(amount / dues);

            for (let i = 1; i <= dues; i++) {

                let interest = Math.round(amount * 0.02)
                let total = Math.round(debt_payment + interest, 0);
                let pending = Math.round(amount - debt_payment, 0);

                let row = `
                <tr>
                    <td>${i}</td>   
                    <td>${date.format('DD-MM-YYYY')}</td>
                    <td>${debt_payment}</td>
                    <td>${interest}</td>
                    <td>${total}</td>
                    <td>${pending}</td>
                </tr>`;

                //insertando filas
                $('.table tbody').append(row);
                //aumentando fecha
                date.add(1, 'month');
                //actualizando totales
                amount = amount - debt_payment;
            }
        }
    });
</script>
@endsection
@endsection