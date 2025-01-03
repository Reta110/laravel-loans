@component('mail::message')
# Login

The user {{ $user->name }} has been logged.


Thanks,<br>
{{ config('app.name') }}
@endcomponent
