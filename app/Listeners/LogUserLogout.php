<?php

namespace App\Listeners;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogUserLogout
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event)
    {
        $user = $event->user; // Instancia del modelo User

        if ($user instanceof \App\Models\User) {
            $user->is_online = true; // Actualiza el estado
            $user->save();          // Guarda el cambio
        }
    }
}
