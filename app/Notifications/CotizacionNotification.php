<?php

namespace App\Notifications;

use App\Models\Cotizaciones\Cotizacion;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CotizacionNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($cotizacion, $type, $old_cotizacion = false)
    {
        $this->cotizacion = $cotizacion;
        $this->type = $type;
        $this->old_cotizacion = $old_cotizacion;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'id' => $this->cotizacion->id,
            'nombre_facturar' => $this->cotizacion->nombre_facturar,
            'cliente_proyecto' => $this->cotizacion->cliente_proyecto,
            'documento' => $this->cotizacion->documento,
            'direccion' => $this->cotizacion->direccion,
            'telefono' => $this->cotizacion->telefono,
            'fecha' => $this->cotizacion->fecha,
            'email' => $this->cotizacion->email,
            'estado' => $this->cotizacion->estado,
            'accion' => $this->type['accion'],
            'tabla' => $this->type['tabla'],
            'old_nombre_facturar' => (!$this->old_cotizacion)? false : $this->old_cotizacion->nombre_facturar,
            'old_cliente_proyecto' => (!$this->old_cotizacion)? false : $this->old_cotizacion->cliente_proyecto,
            'old_documento' => (!$this->old_cotizacion)? false : $this->old_cotizacion->documento,
            'old_direccion' => (!$this->old_cotizacion)? false : $this->old_cotizacion->direccion,
            'old_telefono' => (!$this->old_cotizacion)? false : $this->old_cotizacion->telefono,
            'old_fecha' => (!$this->old_cotizacion)? false : $this->old_cotizacion->fecha,
            'old_email' => (!$this->old_cotizacion)? false : $this->old_cotizacion->email,
            'old_estado' => (!$this->old_cotizacion)? false : $this->old_cotizacion->estado,
        ];
    }
}
