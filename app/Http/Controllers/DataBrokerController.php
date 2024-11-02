<?php

namespace App\Http\Controllers;

use App\Models\DataBroker;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class DataBrokerController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        // Validación de los datos entrantes
        $request->validate([
            'ph' => 'required|numeric',
            'liters_min' => 'required|numeric',
            'distance_cm' => 'required|numeric',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'broker_id' => 'required|exists:brokers,id', // Asumiendo que hay una tabla brokers
        ]);

        // Crear un nuevo DataBroker
        $dataBroker = DataBroker::create($request->all());

        // Retornar una respuesta JSON con el nuevo recurso creado
        return response()->json([
            'message' => 'DataBroker created successfully',
            'data' => $dataBroker
        ], 201);
    }
}
