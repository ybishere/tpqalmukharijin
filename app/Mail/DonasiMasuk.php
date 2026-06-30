<?php

namespace App\Mail;

use App\Models\Donasi;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DonasiMasuk extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Donasi $donasi) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '🎉 Donasi Baru Masuk — ' . $this->donasi->program->nama_program,
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.donasi-masuk',
            with: [
                'donasi'  => $this->donasi,
                'program' => $this->donasi->program,
            ],
        );
    }
}