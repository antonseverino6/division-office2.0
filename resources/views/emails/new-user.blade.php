@component('mail::message')
# You've been assigned as {{ (! $user['admin']) ? 'user' : 'admin' }} by the admin of SDO Rizal 

Your account's password is : {{$user['password']}}.

@component('mail::button', ['url' => 'http://127.0.0.1:8000/login'])
Go to Login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
