<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;
    public $order;
    public $pdf;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order,$pdf)
    {
        $this->order = $order;
        $this->pdf = $pdf;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.mail')
        ->from('satriotol69@gmail.com')
        ->subject('Invoice Ninetynine Konveksi')
        ->attachData($this->pdf->output(),"invoice_pdf.pdf");
    }
}
