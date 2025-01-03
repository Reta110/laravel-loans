@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
        {{__('messages.loan')}}
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($loan, ['route' => ['loans.update', $loan->id], 'method' => 'patch']) !!}

                        @include('loans.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection