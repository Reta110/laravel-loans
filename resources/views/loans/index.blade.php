@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1 class="pull-left">
        {{__('messages.loans')}}
    </h1>
    <h1 class="pull-right">
        @can('advancedActions')
        <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('loans.create') !!}">
            {{__('messages.add_new')}}
        </a>
        @endcan
    </h1>
</section>
<div class="content">
    <div class="clearfix"></div>

    @include('flash::message')

    <div class="clearfix"></div>
    <div class="box box-primary">
        <div class="box-body">
            @include('loans.table')
        </div>
    </div>
    <div class="text-center">

    </div>
</div>
@endsection