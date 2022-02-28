<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users\User;
use App\Models\Users\InformacionPersonal;
use Carbon\Carbon;

class UsuarioController extends Controller
{
    public function index(){
        return view('usuarios.index');
    }

    public function informacionPersonal(){
        $informacion = new InformacionPersonal([
            'user_id' => '1',
            'documento' => '1088',
            'nombres' => 'pruebas',
            'apellidos' => 'pruebas',
            'telefono' => '132456',
            'sexo' => 'f',
            'fecha_nacimiento' => Carbon::now(),
            'ciudad' => 'prueba',
            'foto' => 'prueba'
        ]);

        $informacion->save();
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
			$imageName = time() . '.' . $request->foto->extension();
        	$request->foto->move(public_path('img/img_usuarios'), $imageName);
		}else{
            $imageName = "default.jpg";
        }

        $informacion->foto = $imageName;
        $informacion->save();

        $user->assignRole($request->role);
        return response()->json(['saved' => true]);
    }

    public function update(User $user, Request $request){

        $user->email = $request->email;
        if(isset($request->password)){
            $user->password = $request->password;
        }
        $user->update();
        $user->refresh()->syncRoles($request->role);

        $informacion_personal = InformacionPersonal::where('user_id', '=', $user->id)->get();

        if($informacion_personal[0]->foto != "default.jpg"){
            $image_path = "img/img_usuarios/".$informacion_personal[0]->foto;

            if (file_exists($image_path)) {
                @unlink($image_path);
            }
        }

        if(isset($request->foto)){
			$imageName = time() . '.' . $request->foto->extension();
        	$request->foto->move(public_path('img/img_usuarios'), $imageName);
		}else{
            $imageName = "default.jpg";
        }

        $informacion_personal[0]->documento = $request->documento;
        $informacion_personal[0]->nombres = $request->nombres;
        $informacion_personal[0]->apellidos = $request->apellidos;
        $informacion_personal[0]->telefono = $request->telefono;
        $informacion_personal[0]->sexo = $request->sexo;
        $informacion_personal[0]->fecha_nacimiento = $request->fecha_nacimiento;
        $informacion_personal[0]->ciudad = $request->ciudad;
        $informacion_personal[0]->update();

        return response()->json(['saved' => true]);

    }

    public function delete(User $user){
        $user->delete();
		return response()->json(['delete' => $user]);
    }

    public function get(User $user){
        return response()->json(['usuario' => $user->load('informacionPersonal')]);
    }

    public function getAll(){
        return response()->json(['usuarios' => User::with('informacionPersonal')->get()]);
    }
}
