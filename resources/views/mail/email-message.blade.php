@component('mail::message')
# Verification Code

Your verification code is: **{{ $data[0] }}**

Thank you for registering with us!

Thanks,<br>
{{ config('app.name') }}
@endcomponent
