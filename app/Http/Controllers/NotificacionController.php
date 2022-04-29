<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificacionController extends Controller
{
    public function index($tipo = 'unread'){

        $notificaciones = ($tipo == 'unread')? auth()->user()->unreadNotifications : auth()->user()->readNotifications;

        return view('notificaciones.index', compact('notificaciones', 'tipo'));
    }

    public function readAll(){
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }

    public function read($id){
        auth()->user()->unreadNotifications->when($id, function($query) use ($id){
            return $query->where('id', $id);
        })->markAsRead();
        return redirect()->back();
    }

    public function show($id){
        $notificacion = auth()->user()->notifications->where('id', $id);
        return view('notificaciones.show', compact('notificacion'));
    }
}
