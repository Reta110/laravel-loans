@component('mail::message')
# Se creó una actividad

Se ha registrado un {{ $activity->activityType->name }}

@component('mail::button', ['url' => route('activities.show', $activity->id)])
    Revisar
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
