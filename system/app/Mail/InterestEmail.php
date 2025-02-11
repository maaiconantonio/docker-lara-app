<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Cake;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InterestEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $cake;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, Cake $cake)
    {
        $this->user = $user;
        $this->cake = $cake;
    }

    public function build()
    {
        return $this->view('emails.interest')->subject('Item disponível em nosso site!');
    }
}
