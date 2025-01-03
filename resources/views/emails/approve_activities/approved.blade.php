@component('mail::message')
# Se aprobó su pago exitosamente

Saludos {{ $activity->loan->client->name }}, <br><br>
hemos aprobado tu pago por un monto de: $ {{ number_format($activity->amount + $activity->earnings,0,",",".") }}.

Gracias<br>
{{ config('app.name') }}
@endcomponent