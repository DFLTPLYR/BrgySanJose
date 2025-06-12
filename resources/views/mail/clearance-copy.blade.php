<x-mail::message>
# Introduction

The body of your message.

@isset($embeddedImages)
@foreach($embeddedImages as $cid => $imagePath)
<div>
    <img src="{{ $message->embed($imagePath) }}" alt="Embedded Image">
</div>
@endforeach
@endisset

<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
