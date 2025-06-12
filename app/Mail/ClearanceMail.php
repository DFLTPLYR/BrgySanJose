<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ClearanceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $embeddedImages;

    public $clearanceType;

    public $receiver;

    /**
     * Create a new message instance.
     */
    public function __construct(array $embeddedImages, string $clearanceType, string $receiver)
    {
        $this->embeddedImages = $embeddedImages;
        $this->clearanceType = $clearanceType;
        $this->receiver = $receiver;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Clearance Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.clearance-mail',
            with: [
                'embeddedImages' => $this->embeddedImages,
                'clearanceType' => $this->clearanceType,
                'receiver' => $this->receiver,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
