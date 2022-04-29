<?php

namespace App\Notifications;

use App\Models\Users\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, $type, $user_old = false)
    {
        $this->user = $user->load('informacionPersonal');
        $this->type = $type;
        $this->user_old = $user_old;
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
            'id' => $this->user->id,
            'email' => $this->user->email,
            'documento' => $this->user->informacionPersonal->documento,
            'nombres' => $this->user->informacionPersonal->nombres,
            'apellidos' => $this->user->informacionPersonal->apellidos,
            'telefono' => $this->user->informacionPersonal->telefono,
            'sexo' => $this->user->informacionPersonal->sexo,
            'fecha_nacimiento' => $this->user->informacionPersonal->fecha_nacimiento,
            'ciudad' => $this->user->informacionPersonal->ciudad,
            'accion' => $this->type['accion'],
            'tabla' => $this->type['tabla'],
            'old_documento' => (!$this->user_old)? false : $this->user_old->informacionPersonal->documento,
            'old_nombres' => (!$this->user_old)? false : $this->user_old->informacionPersonal->nombres,
            'old_apellidos' => (!$this->user_old)? false : $this->user_old->informacionPersonal->apellidos,
            'old_telefono' => (!$this->user_old)? false : $this->user_old->informacionPersonal->telefono,
            'old_sexo' => (!$this->user_old)? false : $this->user_old->informacionPersonal->sexo,
            'old_fecha_nacimiento' => (!$this->user_old)? false : $this->user_old->informacionPersonal->fecha_nacimiento,
            'old_ciudad' => (!$this->user_old)? false : $this->user_old->informacionPersonal->documento,
        ];
    }
}
