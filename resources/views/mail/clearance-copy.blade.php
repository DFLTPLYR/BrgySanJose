@component('mail::message')

<div style="margin-top: 32px; text-align: center; user-select: none;">
    <img src="{{ $message->embed(public_path('/images/logo/logomain.png')) }}" alt="Barangay San Jose Tagaytay City Logo" style="height: 80px;">
</div>

# Hello, There is a New Clearance

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


Thanks,<br>
Barangay San Jose Tagaytay City
@endcomponent
