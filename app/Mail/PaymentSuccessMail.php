<?php

namespace App\Mail;

use App\Models\Book;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;

    public function __construct(Book $booking)
    {
        $this->booking = $booking;
    }

    public function build()
    {
        return $this->view('emails.payment_success')
                    ->subject('Payment Confirmation');
    }
}
