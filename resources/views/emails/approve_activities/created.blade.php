@component('mail::message')
# Se ha registrado su notificación de pago

Saludos {{ $activity->loan->client->name }}, <br><br>
hemos registrado tu pago para ser aprobado <br>
por un monto de: $ {{ number_format($activity->amount + $activity->earnings,0,",",".") }}.

Gracias<br>
{{ config('app.name') }}
@endcomponent
