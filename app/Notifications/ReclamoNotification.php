<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;

class ReclamoNotification extends Notification
{
    use Queueable;

    protected $reclamo;

    public function __construct($reclamo)
    {
        $this->reclamo = $reclamo;
    }

    public function via($notifiable)
    {
        return ['database']; // Guardar en la base de datos
    }

    public function toDatabase($notifiable)
    {
        $user = $this->reclamo->users; // Relación entre Reclamo y User

        return [
            'message' => 'Se ha registrado un nuevo reclamo.',
            'asunto' => $this->reclamo->asunto ?? 'N/A', // Asunto del reclamo
            'descripcion' => \Illuminate\Support\Str::limit($this->reclamo->descripcion, 50) ?? 'No disponible', // Descripción corta
            'usuario' => $user->name ?? 'Desconocido', // Nombre del usuario relacionado
        ];
    }
}
