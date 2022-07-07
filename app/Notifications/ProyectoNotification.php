<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProyectoNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($proyecto, $type, $old_proyecto = false)
    {
        $this->proyecto = $proyecto;
        $this->type = $type;
        $this->old_proyecto = $old_proyecto;
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
            'id' => $this->proyecto->id,
            'nombre' => $this->proyecto->nombre,
            'fecha_inicial' => $this->proyecto->fecha_inicial,
            'fecha_final' => $this->proyecto->fecha_final,
            'estado' => $this->proyecto->estado,
            'accion' => $this->type['accion'],
            'tabla' => $this->type['tabla'],
            'old_nombre' => (!$this->old_proyecto)? false : $this->old_proyecto->nombre,
            'old_fecha_inicial' => (!$this->old_proyecto)? false : $this->old_proyecto->fecha_inicial,
            'old_fecha_final' => (!$this->old_proyecto)? false : $this->old_proyecto->fecha_final,
            'old_estado' => (!$this->old_proyecto)? false : $this->old_proyecto->estado,
        ];
    }
}
