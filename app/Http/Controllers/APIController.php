<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;

class APIController extends Controller
{
    public function searchTrip(Request $request)
    {
        $origen = $request->input('origin');
        $destino = $request->input('destination');
        $fecha = $request->input('output_date');

        // Realiza la consulta a la base de datos
         $viajes = Trip::where('origin', $origen)
                     ->where('destination', $destino)
                     ->whereDate('output_date', $fecha)
                     ->get();

        

                     return response()->json([
                        'viajes' => $viajes->map(function ($viaje) {
                            return [
                                'id' => $viaje->id,
                                'origin' => [
                                    'name' => $viaje->originTerminal->name
                                ],
                                'destination' => [
                                    'name' => $viaje->destinationTerminal->name
                                ],
                                'output_time' => $viaje->output_time
                            ];
                        }),
                        'status' => 200
                    ]);
                    
    }       

}
