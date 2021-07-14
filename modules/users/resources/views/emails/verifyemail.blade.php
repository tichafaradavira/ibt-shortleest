

@component('mail::message')

Dear {{$user->first_name}}

Thank you for creating an account on ShortLeest.
We're happy you  chose ShortLeest for as your rental applications management system.

Please find below your One Time Pin.
The code expires in an hour.

{{$user->otp}}


Thanks,<br>
IBT ShortLeest
@endcomponent
