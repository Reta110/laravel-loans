@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Withdrawal
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('withdrawals.show_fields')
                    <a href="{!! route('withdrawals.index') !!}" class="btn btn-default">{{__('messages.back')}}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
