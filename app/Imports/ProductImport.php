<?php

namespace App\Imports;

use App\Models\Productos\Categoria;
use App\Models\Productos\Producto;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ProductImport implements WithMultipleSheets, WithStartRow, ToModel
{
    public function sheets(): array
    {
        return [
            'INVENTARIO' => $this,
        ];
    }
    public function startRow(): int
    {
        return 3;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $categoria = Categoria::where('nombre', $row[0])->get();
        if(count($categoria) == 0 && $row[0] != ''){
            $categoria = new Categoria([
                'nombre' => $row[0]
            ]);
            $categoria->save();
        }
        $categoria = Categoria::where('nombre', $row[0])->get()->first();
        if($row[0]!=null){
            return new Producto([
                'nombre' => $row[2],
                'descripcion' => $row[2],
                'referencia' => $row[1],
                'color' => 'sin definir',
                'cantidad' => $row[5],
                'marca' => $row[6],
                'categoria_id' => $categoria->id,
            ]);
        }

    }
}
