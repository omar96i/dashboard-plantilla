<?php

namespace App\Http\Controllers\Cotizaciones;

use App\Http\Controllers\Controller;
use App\Models\Cotizaciones\Cotizacion;
use App\Models\Cotizaciones\CotizacionFile;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;

class CotizacionFileController extends Controller
{
    public function store(Request $request, Cotizacion $cotizacion)
    {
        // Verifica si se ha enviado un archivo en la solicitud
        if ($request->hasFile('file')) {
            // Sube el archivo a Cloudinary
            $uploadedFile = Cloudinary::upload($request->file('file')->getRealPath(), [
                'folder' => 'cotizacion_planos', // Carpeta donde se almacenará el archivo en Cloudinary
            ]);
    
            // Obtiene la URL segura del archivo en Cloudinary
            $secureUrl = Cloudinary::getSecurePath($uploadedFile->getPublicId(), [
                'resource_type' => 'auto', // Detecta automáticamente el tipo de archivo
            ]);

            $filename = pathinfo($uploadedFile->getSecurePath(), PATHINFO_FILENAME);
    
            // Guarda la URL segura en la tabla CotizacionFile
            $cotizacionFile = new CotizacionFile([
                'cotizacion_id' => $cotizacion->id,
                'file' => $filename,
            ]);
            $cotizacionFile->save();
    
            return response()->json(['status' => true, 'secureUrl' => $secureUrl]);
        }
    
        return response()->json(['status' => false, 'message' => 'No se ha enviado ningún archivo']);
    }

    public function get(Cotizacion $cotizacion){
        return response()->json(['files' => $cotizacion->load('files')]);
    }

    public function delete(CotizacionFile $file){
        $file->delete();
        return response()->json(['deleted' => true]);
    }
}
