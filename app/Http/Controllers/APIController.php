<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\Ticket;
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
                                'output_time' => $viaje->output_time,
                                "price" => (string) $viaje->price
                            ];
                        }),
                        'status' => 200
                    ]);
                    
    }       

    public function getTrip($id) {
        $trip = Trip::with(['originTerminal', 'destinationTerminal'])
            ->findOrFail($id);

        // Retornar la información del trip
        return response()->json([
            'id' => $trip->id,
            'origin' => [
                'name' => $trip->originTerminal->name,
                'lat' => $trip->originTerminal->lat,
                'lng' => $trip->originTerminal->lng,
            ],
            'destination' => [
                'name' => $trip->destinationTerminal->name,
                'lat' => $trip->destinationTerminal->lat,
                'lng' => $trip->destinationTerminal->lng,
            ], 
            'output_date' => $trip->output_date,
            'output_time' => $trip->output_time,
            'price' => $trip->price,
        ]);
             
    }

    public function buy(Request $request) {
        Ticket::create([
            "user_id" => $request->input("user_id"),
            "trip_id" => $request->input("trip_id"),
            "amount" => $request->input("amount")
        ]);

        return response()->json([
            "status" => 200,
            "ok" => "ok",
        ]);
    }
}
