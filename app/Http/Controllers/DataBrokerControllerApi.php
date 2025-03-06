<?php

namespace App\Http\Controllers;

use App\Models\DataBroker;
use Illuminate\Http\Request;

class DataBrokerControllerApi extends Controller
{
    //
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $validated = $request->validate([
            'ph' => 'required|numeric|min:0|max:14', // pH debe estar entre 0 y 14
            'liters_min' => 'required|numeric|min:0', // No puede ser negativo
            'distance_cm' => 'required|numeric|min:0',
            'date' => 'required|date', // Fecha válida
            'time' => 'required|date_format:H:i:s', // Formato de hora válido
            'broker_id' => 'required|exists:brokers,id', // broker_id debe existir en la tabla brokers
        ]);

        // Crear el registro en la base de datos
        $dataBroker = DataBroker::create($validated);

        // Retornar la respuesta
        return response()->json([
            'message' => 'DataBroker creado exitosamente',
            'data' => $dataBroker
        ], 201);
    }
}
