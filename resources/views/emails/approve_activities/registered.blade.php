@component('mail::message')
# Han registrado un pago en la plataforma

El usuario: {{ auth()->user()->name }}, <br><br>
registró un pago por el monto de: $ {{ number_format($activity->amount + $activity->earnings,0,",",".") }}

@component('mail::button', ['url' => route('approve-activities.index')])
Revisar
@endcomponent

@component('mail::table')
| PAYMENT DETAILS | | |
| ------------- |:-------------:| --------:|
| Pay | {{ number_format($activity->amount,0,",",".") }} |
| Earnigns | {{ number_format($activity->earnings,0,",",".") }} |
| Date | {{$activity->date}} |
@endcomponent


@component('mail::table')
| LOAN DETAILS | | |
| ------------- |:-------------:| --------:|
| User | {{$activity->loan->user->name}} |
| Client | {{$activity->loan->client->name}} |
| Loan amount | {{ number_format($activity->loan->amount,0,",",".") }} |
| Loan date | {{$activity->loan->date}} |
| Loan expires at | {{$activity->loan->expires_at}} |
@endcomponent

Gracias<br>
{{ config('app.name') }}
@endcomponent