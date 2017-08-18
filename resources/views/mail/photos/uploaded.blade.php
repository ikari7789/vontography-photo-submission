@component('mail::message')
# Photo Uploaded

Your photo has been uploaded!

@component('mail::button', ['url' => $url])
View Photo
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
