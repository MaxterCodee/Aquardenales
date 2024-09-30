<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

use Illuminate\Http\Request;
use Parsedown;

class GeminiController extends Controller
{
    //
    public function texto(Request $request)
    {
        // Validar el campo "text"
        $request->validate([
            'text' => 'required|string|max:255', // Puedes ajustar la validación según tus necesidades
        ]);

        // Obtener el texto
        $text = $request->input('text');

        // Preparar el payload para enviar al API
        $payload = [
            'contents' => [
                [
                    'parts' => [
                        [
                            'text' => $text
                        ]
                    ]
                ]
            ]
        ];

        // Consumir el endpoint de Google Generative Language
        $response = Http::post('https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent?key=AIzaSyD2B1smXfqDRwE0alxY-s2n0mH7x78H93s', $payload);

        // Verificar si la respuesta fue exitosa
        if ($response->successful()) {
            // Obtener el contenido de la respuesta
            $data = $response->json();

            // Procesar la respuesta según tu necesidad
            $responseText = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'No hay respuesta disponible';

            // Convertir el texto Markdown a HTML
            $parsedown = new Parsedown();
            $htmlContent = $parsedown->text($responseText);

            // Retornar una respuesta con el texto generado
            return response()->json(['message' => 'Texto recibido', 'generated_text' => $htmlContent], 200);
        } else {
            // Manejar el error de la respuesta
            return response()->json(['error' => 'No se pudo generar contenido'], $response->status());
        }
    }
}
