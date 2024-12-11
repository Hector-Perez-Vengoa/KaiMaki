<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class CambiosNegociacion extends Notification
{
    use Queueable;

    protected $negociacion;
    protected $tipo;

    public function __construct($negociacion, $tipo)
    {
        $this->negociacion = $negociacion;
        $this->tipo = $tipo;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'negociacion_id' => $this->negociacion->id_negociacion,
            'mensaje' => $this->tipo === 'propuesta'
                ? 'Se han propuesto cambios en la negociación.'
                : 'Se ha respondido a los cambios en la negociación.',
            'detalle' => 'Revisa los cambios en la negociación ',
            'nueva_fech_reserva' => $this->negociacion->nueva_fech_reserva,
            'hora_inicio' => $this->negociacion->hora_inicio,
            'ubicacion_nueva' => $this->negociacion->ubicacion_nueva,
            'monto' => $this->negociacion->monto,
        ];
    }
}

