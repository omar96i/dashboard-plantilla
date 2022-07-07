<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ActividaNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($actividad, $type, $old_actividad = false)
    {
        $this->actividad = $actividad;
        $this->type = $type;
        $this->old_actividad = $old_actividad;
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
            'id' => $this->actividad->id,
            'descripcion' => $this->actividad->descripcion,
            'fecha_inicio' => $this->actividad->fecha_inicio,
            'fecha_final' => $this->actividad->fecha_final,
            'estado' => $this->actividad->estado,
            'accion' => $this->type['accion'],
            'tabla' => $this->type['tabla'],
            'old_descripcion' => (!$this->old_actividad)? false : $this->old_actividad->odescripcion,
            'old_fecha_inicio' => (!$this->old_actividad)? false : $this->old_actividad->fecha_inicio,
            'old_fecha_final' => (!$this->old_actividad)? false : $this->old_actividad->fecha_final,
            'old_estado' => (!$this->old_actividad)? false : $this->old_actividad->estado,
        ];
    }
}
