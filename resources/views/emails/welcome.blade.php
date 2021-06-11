@component('mail::message')
# Thanks for signing up to LSAPP

Feel free to click below to get started

@component('mail::button', ['url' => '/home'])
Get Started
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
