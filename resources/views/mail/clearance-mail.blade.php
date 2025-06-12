<x-mail::message>@isset($receiver)
    # Hello <h2> {{ $receiver }} </h2>, Thank you for Applying to our Clearance
    # This is the copy of what you send:
    @endisset

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
    @isset($receiver)
    <h1> {{ $receiver }} </h1>
    @endisset
</x-mail::message>
