@component('mail::message')
# Saludos,

Se ha registrado un depósito a tu nombre, por el monto de: {{ $deposit->amount }}

@component('mail::button', ['url' => route('deposits.show', $deposit->id)])
    Revisar
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
