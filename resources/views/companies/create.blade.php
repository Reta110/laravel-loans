@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {{__('messages.company')}}
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'companies.store']) !!}

                        @include('companies.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
