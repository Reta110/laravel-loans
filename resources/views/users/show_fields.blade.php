<!-- Id Field -->
<div class="form-group  col-sm-3">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $user->id !!}</p>
</div>

<!-- Name Field -->
<div class="form-group  col-sm-3">
    {!! Form::label('name', 'Name:') !!}
    <p>{!! $user->name !!}</p>
</div>

<!-- Email Field -->
<div class="form-group  col-sm-3">
    {!! Form::label('email', 'Email:') !!}
    <p>{!! $user->email !!}</p>
</div>

<!-- Phone Field -->
<div class="form-group  col-sm-3">
    {!! Form::label('phone', 'Phone:') !!}
    <p>{!! $user->phone !!}</p>
</div>

<!-- Rut Field -->
<div class="form-group  col-sm-3">
    {!! Form::label('rut', 'Rut:') !!}
    <p>{!! $user->rut !!}</p>
</div>

<!-- Role Field -->
<div class="form-group  col-sm-3">
    {!! Form::label('role', 'Role:') !!}
    <p>{!! $user->role !!}</p>
</div>

<!-- Company Id Field -->
<div class="form-group  col-sm-3">
    {!! Form::label('company_id', 'Company Id:') !!}
    <p>{!! $user->company->name !!}</p>
</div>

<!-- Guarantor Id Field -->
<div class="form-group  col-sm-3">
    {!! Form::label('user_id', 'Guarantor:') !!}
    <p>{!! $user->guarantor->name !!}</p>
</div>

<!-- Guarantor Id Field -->
<div class="form-group  col-sm-12">
    {!! Form::label('observation', 'Observation:') !!}
    <p>{!! $user->observation !!}</p>
</div>