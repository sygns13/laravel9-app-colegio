<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VentaRegistrada extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Celular del asesor (Personal) que registró la venta.
     */
    public string $celularAsesor;

    /**
     * Link de WhatsApp armado con el celular del asesor.
     */
    public string $whatsappUrl;

    /**
     * @param string $celularAsesor Valor de $personal->celular
     */
    public function __construct(string $celularAsesor)
    {
        $this->celularAsesor = $celularAsesor;

        // El link de WhatsApp solo admite dígitos: se quitan espacios, "+" y otros símbolos.
        //$numero = preg_replace('/\D/', '', $celularAsesor);
        $numero = "+51941183459";

        $this->whatsappUrl = 'https://api.whatsapp.com/send/?phone=' . $numero
            . '&text=' . rawurlencode('Hola necesito repuestos')
            . '&type=phone_number&app_absent=0';
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Tu compra se ha realizado correctamente',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.venta-registrada',
        );
    }

    /**
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
