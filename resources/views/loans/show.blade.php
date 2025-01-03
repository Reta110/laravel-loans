@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1 class="pull-left">
        Loan
    </h1>
    <h1 class="pull-right">
        @can('advancedActions')
        <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('activities.create') !!}">
            {{__('messages.add_new_activity')}}</a>
        @endcan
    </h1>
</section>
<div class="content">
    <div class="clearfix"></div>
    <div class="box box-primary">
        <div class="box-body">
            <div class="row" style="padding-left: 20px">
                @include('loans.show_fields')
                <a href="{!! route('loans.index') !!}" class="btn btn-default">{{__('messages.back')}}</a>
            </div>
        </div>
    </div>
</div>
@endsection