@component('mail::message')
# Introduction

Your OTP is {{ $OTP }}.

@component('mail::button', ['url' => route('verify.get', $OTP)])
Authenticate
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
