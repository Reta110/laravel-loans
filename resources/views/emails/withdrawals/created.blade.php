@component('mail::message')
# Saludos,

Se ha registrado un retiro a tu nombre, por el monto de: {{ $withdrawal->amount }}

@component('mail::button', ['url' => route('withdrawals.show', $withdrawal->id)])
    Revisar
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
