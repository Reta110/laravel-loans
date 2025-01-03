@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {{__('messages.activity_approval')}}
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'approve-activities.store']) !!}

                        @include('approve_activities.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
