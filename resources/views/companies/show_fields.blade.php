<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('messages.id')) !!}
    <p>{!! $company->id !!}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', __('messages.name')) !!}
    <p>{!! $company->name !!}</p>
</div>

<!-- Slug Field -->
<div class="form-group">
    {!! Form::label('slug', __('messages.slug')) !!}
    <p>{!! $company->slug !!}</p>
</div>