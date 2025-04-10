<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Boleto de Autobús</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 py-10">
    <div class="max-w-md mx-auto bg-white rounded-2xl shadow-xl border border-gray-300 p-6">
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Boleto de Autobús</h1>
            <p class="text-sm text-gray-500">Transportes Ejecutivos</p>
        </div>

        <div class="space-y-4 text-gray-700 text-sm">
            <div class="flex justify-between">
                <span class="font-semibold">Pasajero:</span>
                <span>{{ Auth::user()->name }}</span>
            </div>
            <div class="flex justify-between">
                <span class="font-semibold">Origen:</span>
                <span>{{ $ticket->trip->originTerminal->name }}</span>
            </div>
            <div class="flex justify-between">
                <span class="font-semibold">Destino:</span>
                <span>{{ $ticket->trip->destinationTerminal->name }}</span>
            </div>
            <div class="flex justify-between">
                <span class="font-semibold">Fecha de salida:</span>
                <span>{{ $ticket->trip->output_date }}</span>
            </div>
            <div class="flex justify-between">
                <span class="font-semibold">Hora de salida:</span>
                <span>{{ $ticket->trip->output_time }}</span>
            </div>
            <div class="flex justify-between border-t pt-4">
                <span class="font-bold">Total a Pagar:</span>
                <span class="font-bold text-green-600">
                  {{$ticket->amount}}
                </span>
            </div>
        </div>

        <div class="mt-6 text-center">
            <p class="text-xs text-gray-400">Presenta este boleto al abordar. No es transferible.</p>
        </div>
    </div>
</body>
</html>
