<?php

namespace App\Mail;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailForQueueMail extends Mailable{
    use Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data){
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
        $pdf = Pdf::loadView('pdf', $this->data)->output();

        return $this->from(env('MAIL_FROM_ADDRESS'))
                    ->to($this->data['para'])
                    ->cc($this->data['copia'])
                    ->subject('Algo Random')
                    ->view('email')
                    ->with([
                        'title' => $this->data['title']
                    ])
                    ->attachData($pdf, 'archivo.pdf');
    }
}
