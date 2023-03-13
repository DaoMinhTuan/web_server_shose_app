<?php

namespace App\Http\Controllers\mail;

use Illuminate\Routing\Controller;
use App\Http\Controllers\mail\MailNotify;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
class MailController extends Controller
{
    public function index()
    {
        $data = [
            'subject' => 'Shose App',
            'body' => 'Welcome to Shose App'
        ];

     
        Mail::to('tuandmph16005@fpt.edu.vn')->send(new MailNotify($data));
        return response()->json(['Great check your mail box']);
       
    }
}
