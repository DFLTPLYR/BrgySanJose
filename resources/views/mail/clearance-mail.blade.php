<x-mail::message>
# Introduction


@isset($clearanceType)
<h1> {{ $clearanceType }} </h1>
@endisset

@isset($receiver)
<h1> {{ $receiver }} </h1>
@endisset


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
