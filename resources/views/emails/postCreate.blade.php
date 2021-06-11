@component('mail::message')
# New Post Created

Your blog post has been created and is publically viewable on LSAPP.

Click below to view full post:

@component('mail::button', ['url' => ''])
View Post
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
