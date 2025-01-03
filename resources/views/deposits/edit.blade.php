@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Deposit
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($deposit, ['route' => ['deposits.update', $deposit->id], 'method' => 'patch']) !!}

                        @include('deposits.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection