<?php

namespace App\Http\Controllers\mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailNotify extends Mailable
{
    use Queueable, SerializesModels;
    private $data = [];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct($data)
     {
       $this->data = $data;
     }
     public function build()
     {
        return $this->from('minhtuan080722@gmail.com', 'Shose App')
        ->subject($this->data['subject'])->view('emails.index')->with('data',$this->data);
     }
    }  