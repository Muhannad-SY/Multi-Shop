<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;


class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    public $order_id;
    public $address;
    public $zip_code;
    

    /**
     * Create a new message instance.
     */
    public function __construct($order)
    {
        $this->order_id = $order->id;
        $this->address = $order->address->adreess;
        $this->zip_code = $order->address->zip_code;
        
        
    }


    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('multi_shop@example.com', 'Multi Shop'),
            replyTo: [new Address('muhannad55sy@gmail.com', 'Muhannad')],
            subject: 'Order Shipped',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'theme.mails.orderShipped',
            with: [
                'order_id' => $this->order_id,
                'zip_code' => $this->zip_code,
                'address' => $this->address,
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
