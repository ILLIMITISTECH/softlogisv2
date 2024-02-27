<?php

namespace App\Http\Controllers;

use App\Mail\LogisticaMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function index()

    {
        $mailData = [

            'title' => 'Mail from illimitis.com',

            'body' => 'This is for testing email using smtp.'
        ];

        Mail::to('your_email@gmail.com')->send(new LogisticaMail($mailData));

        dd("Email is sent successfully.");

    }
}
