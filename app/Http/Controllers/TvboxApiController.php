<?php

namespace App\Http\Controllers;

use App\Models\Tvbox;
use Illuminate\Http\Request;

class TvboxApiController extends Controller
{
    public function tvboxInfo()
    {
        // Obtener todas las TV Box con la información necesaria
        $tvboxes = Tvbox::with('client')->get();

        // Mapear la información deseada de cada TV Box
        $tvboxInfo = $tvboxes->map(function ($tvbox) {
            return [
                'nombre_cliente' => $tvbox->client->nombre,
                'estado_pago' => $tvbox->client->estado_pago,
                'codigo_tvbox' => $tvbox->codigo,
            ];
        });

        // Devolver la información en formato JSON
        return response()->json($tvboxInfo);
    }
}
