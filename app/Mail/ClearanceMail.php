<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ClearanceMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $embeddedImages;
    public $clearanceType;
    public $receiver;
    public $logoCid;

    public function __construct(array $embeddedImages, string $clearanceType, string $receiver)
    {
        $this->embeddedImages = $embeddedImages;
        $this->clearanceType = $clearanceType;
        $this->receiver = $receiver;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Clearance Mail',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mail.clearance-mail',
            with: [
                'embeddedImages' => $this->embeddedImages,
                'clearanceType' => $this->clearanceType,
                'receiver' => $this->receiver,
                'logoCid' => $this->logoCid ?? null,
            ]
        );
    }

    // ✅ This is only to embed the image
    public function build()
    {
        $this->withSymfonyMessage(function ($message) {
            $this->logoCid = $message->embed(public_path('images/logo/logomain.png'));
        });

        return $this;
    }

    public function attachments(): array
    {
        return [];
    }
}
