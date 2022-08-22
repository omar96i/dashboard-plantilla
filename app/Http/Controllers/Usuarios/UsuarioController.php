<?php

namespace App\Http\Controllers\Usuarios;

use App\Events\UserEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users\User;
use App\Models\Users\InformacionPersonal;
use App\Notifications\UserNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UsuarioController extends Controller
{

    public function prueba(Request $request){
        $response = cloudinary()->upload($request->file('file')->getRealPath())->getSecurePath();
        dd($response);
    }

    public function index(){
        return view('usuarios.index');
    }

    public function store(Request $request){

        $user = new User([
            'email' => $request->email,
            'password' => $request->password
        ]);
        $user->save();

        $informacion = new InformacionPersonal([
            'user_id' => $user->id,
            'documento' => $request->documento,
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'telefono' => $request->telefono,
            'sexo' => $request->sexo,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'ciudad' => $request->ciudad
        ]);

        if(isset($request->foto)){
            $result = $request->foto->storeOnCloudinary('img_usuarios');
            $imageName = $result->getPublicId();
        }else{
            $imageName = "default.jpg";
        }

        $informacion->foto = $imageName;
        $informacion->save();

        $tipo['accion'] = "insert";
        $tipo['tabla'] = "users";

        $user->assignRole($request->role);
        event(new UserEvent($user->load('informacionPersonal'), $tipo));
        return response()->json(['saved' => true]);
    }

    public function update(User $user, Request $request){
        $old_user = $user->load('informacionPersonal');
        $user->email = $request->email;
        if(isset($request->password)){
            $user->password = $request->password;
        }
        $user->update();
        $user->refresh()->syncRoles($request->role);

        $informacion_personal = InformacionPersonal::where('user_id', '=', $user->id)->get();

        if(isset($request->foto)){
            if($informacion_personal[0]->foto != "default.jpg"){
                cloudinary()->destroy($informacion_personal[0]->foto);
            }
            $result = $request->foto->storeOnCloudinary('img_usuarios');
            $informacion_personal[0]->foto = $result->getPublicId();
        }

        $informacion_personal[0]->documento = $request->documento;
        $informacion_personal[0]->nombres = $request->nombres;
        $informacion_personal[0]->apellidos = $request->apellidos;
        $informacion_personal[0]->telefono = $request->telefono;
        $informacion_personal[0]->sexo = $request->sexo;
        $informacion_personal[0]->fecha_nacimiento = $request->fecha_nacimiento;
        $informacion_personal[0]->ciudad = $request->ciudad;
        $informacion_personal[0]->update();


        $tipo['accion'] = "update";
        $tipo['tabla'] = "users";

        event(new UserEvent($user->load('informacionPersonal'), $tipo, $old_user));

        return response()->json(['saved' => true]);

    }

    public function updateFoto(InformacionPersonal $informacion_personal, Request $request){
        if($request->hasFile('foto')){
            // destroy img
            cloudinary()->destroy($informacion_personal->foto);
            // upload img
            $foto = $request->file('foto');
            $publicId = $foto->storeOnCloudinary('img_usuarios')->getPublicId();

            $informacion_personal->foto = $publicId;
            $informacion_personal->update();
            $informacion_personal->save();
        }else{
            return response()->json(['status' => false, 'msg' => 'No es han seleccionado imagenes']);
        }
        return response()->json(['status' => true, 'msg' => 'Imagen actualizada', 'img' => $publicId]);
    }

    public function updateInformacionPersonal(InformacionPersonal $informacion_personal, Request $request){
        $informacion_personal->update($request->all());
        return response()->json(['status' => true, 'msg' => 'actualizacion completa', 'informacion_personal' => $informacion_personal]);
    }

    public function delete(User $user){
        $old_user = $user->load('informacionPersonal');
        $user->delete();
        $tipo['accion'] = "delete";
        $tipo['tabla'] = "users";
        event(new UserEvent($user->load('informacionPersonal'), $tipo, $old_user));
		return response()->json(['delete' => $user]);
    }

    public function get(User $user){
        return response()->json(['usuario' => $user->load('informacionPersonal')]);
    }

    public function updatePassword(User $user, Request $request){
        $user->password = $request->new;
        $user->update();
        $user->save();
        return response()->json(['status' => true]);
    }

    public function getUser(){
        return response()->json(['user' => User::with('informacionPersonal')->find(auth()->user()->id)]);
    }

    public function getAll(){
        return response()->json(['usuarios' => User::with('informacionPersonal')->get()]);
    }
}
