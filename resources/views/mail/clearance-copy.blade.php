@component('mail::message')
# Hello, thank you for applying for our Clearance

@isset($receiver)
**Clearance Type:**
{{ $receiver }}
@endisset

@isset($clearanceType)
**Receiver:**
{{ $clearanceType }}
@endisset

@isset($embeddedImages)
@foreach($embeddedImages as $cid => $imagePath)
<div style="margin: 10px 0;">
    <img src="{{ $message->embed($imagePath) }}" alt="Embedded Image" style="max-width: 100%;">
</div>
@endforeach
@endisset

<div style="margin-top: 32px; text-align: center;">
    <img src="{{ $message->embed(public_path('/images/logo/logomain.png')) }}" alt="Barangay San Jose Tagaytay City Logo" style="height: 80px;">
</div>

Thanks,<br>
Barangay San Jose Tagaytay City
@endcomponent
