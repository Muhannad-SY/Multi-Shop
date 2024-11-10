<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class OrderCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $order__details;
    public $subtotal = 0;
    public $coupon;
    public $address;
    public $products;
    public $order_id;
    public $zip_code;

    /**
     * Create a new message instance.
     */
    public function __construct($order, $products)
    {
        $this->order_id = $order->id;
        $this->order__details = $order->order__details;

        foreach ($this->order__details as $item) {
            $this->subtotal += $item->price * $item->quanity;
        }

        $this->coupon = $order->coupon->discount_amount ?? 0;
        $this->address = $order->address->adreess;
        $this->zip_code = $order->address->zip_code;
        $this->products = $products;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(from: new Address('multi_shop@example.com', 'Multi Shop'), replyTo: [new Address('muhannad55sy@gmail.com', 'Muhannad')], subject: 'Order Created');
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'theme.mails.ordercreated',
            with: [
                'order__details' => $this->order__details,
                'subtotal' => $this->subtotal,
                'coupon' => $this->coupon,
                'address' => $this->address,
                'products' => $this->products,
                'order_id' => $this->order_id,
                'zip_code' => $this->zip_code
            ],
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
