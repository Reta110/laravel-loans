@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {{__('messages.withdraw')}}
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($withdrawal, ['route' => ['withdrawals.update', $withdrawal->id], 'method' => 'patch']) !!}

                        @include('withdrawals.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection