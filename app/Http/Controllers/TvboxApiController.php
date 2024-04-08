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
        $tvboxInfo = $tvboxes->mapWithKeys(function ($tvbox) {
            return [
                $tvbox->codigo => (bool) $tvbox->client->estado_pago,
            ];
        });

        // Devolver la información en formato JSON
        return response()->json($tvboxInfo);
    }

    public function getTvboxInfo($codigo_tvbox)
    {
        // Buscar la TV Box por el código proporcionado
        $tvbox = Tvbox::where('codigo', $codigo_tvbox)->with('client')->first();

        if (!$tvbox) {
            // Si no se encuentra la TV Box, devolver un mensaje de error
            return response()->json(['error' => 'TV Box no encontrada'], 404);
        }

        // Devolver el estado del pago del cliente asociado a la TV Box
        return response()->json(['estado_pago' => (bool) $tvbox->client->estado_pago]);
    }
}
