<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    // Properti untuk menyimpan data yang akan digunakan dalam view email
    use Queueable, SerializesModels;

    protected $order;

    /**
     * Create a new message instance.
     *
     * @param  Order  $order
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Invoice for Order ' . $this->order->id)
            // INI PERINTAH UNTUK MANGGIL VIEW INVOICE YANG MAU DIKIRIM KE PEMBELI
            ->view('email.invoice')
            // ->view('frontpage.my-order.invoice')
            ->with('order', $this->order);
    }
}
