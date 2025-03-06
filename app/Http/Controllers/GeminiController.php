<?php

namespace App\Http\Controllers;

use App\Models\Broker;
use App\Models\DataBroker;
use App\Models\User;
use Carbon\Carbon;
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
            'id' => 'required|integer', // Puedes ajustar la validación según tus necesidades
            'text' => 'required|string|max:255', // Puedes ajustar la validación según tus necesidades
        ]);

        $user = User::find($request->input('id'));

        // Obtener el texto
        $text = $request->input('text');
        // $promt = "<INICIO INSTRUCCIONES>AL SER UN ASISTENTE VIRTUAL ESTARAS EN ESPERA DE QUE EL USUARIO TE SOLICITE DATOS, los cuales son recopilados de sensores en un tinaco, tu eres un asistente personal llamado AquaBot, dale al usuario recomendaciones y advertencias en cuestion de los datos previamente dados, siempre concluye con un consejo de cuidado y uso responsable del agua, no des los datos a no ser que el usuario te los pida. Si el usuario da las gracias despidete formalmente, Si el usuario da las gracias despidete formalmente, Si el usuario da las gracias despidete formalmente terminando la conversacion , si no hay medidas de los sensores aun asi responde al usuario</FIN INSTRUCCIONES> <INICIO PPROMT>";
        $promt = "AquaBot: Un asistente inteligente diseñado para brindar recomendaciones sobre el uso eficiente y responsable del agua y proporcionar información en tiempo real sobre las condiciones del tinaco de agua. AquaBot tiene como objetivos educar a los usuarios sobre prácticas de ahorro de agua en el hogar, proporcionar información en tiempo real sobre el estado del tinaco (capacidad, nivel de pH y gasto de agua) y promover el cuidado y mantenimiento adecuado del sistema de almacenamiento de agua. Sus funciones principales incluyen: consejos sobre ahorro de agua (recomendaciones personalizadas para reducir el consumo en cocina, baño y jardín, y sugerencias para detectar fugas), información sobre sensores del tinaco (capacidad en porcentaje y litros, nivel de pH con sugerencias si está fuera de rango, y reporte del gasto diario y mensual de agua con alertas de consumo inusual), y alertas y mantenimiento (notificaciones cuando el nivel de agua sea bajo o el pH esté en niveles peligrosos, además de recordatorios periódicos para el mantenimiento preventivo del tinaco y los sensores). El tono de AquaBot es informativo, claro y amigable, con un enfoque en la conciencia ambiental.";

        $broker = Broker::where('user_id', $user->id)->first();
        //si broker no tiene datos (null) o esta vacio
        if ($broker) {
            $dataBroker = $broker->data_brokers;
            $lastDataBroker = $dataBroker->last();
            $brockerProfundidad = $broker->depth_cm;
            $capacidadLitros = $broker->liter_capacity;
            $sensorDistancia = $lastDataBroker->distance_cm;

            //calculo de la cantidad de litros
            $altura_agua = $brockerProfundidad - $sensorDistancia;
            $litros_aproximados = round(($altura_agua / $brockerProfundidad) * $capacidadLitros);
            //calculo porcentaje
            $porcentaje = round(($litros_aproximados / $capacidadLitros) * 100);
            //calcular consumo de litros hoy
            $hoy = Carbon::today();
            $litrosGastados = $lastDataBroker
                ->whereDate('date', $hoy)
                ->sum('liters_min');
            $ph = $lastDataBroker->ph;
            $brokerName = $broker->name;
            //obtener ultima medicion "Ultima actualizacion hace $'tiempo'"
            $time = $lastDataBroker->time;
            $date = $lastDataBroker->date;
            $timeUpdate = Carbon::parse($date . ' ' . $time)->diffForHumans();
            //quitar 'en'
            $timeUpdate = str_replace('en ', '', $timeUpdate);

            // Preparar el payload para enviar al API
            $payload = [
                'contents' => [
                    [
                        'parts' => [
                            [
                                'text' => '<INFORMACION MODULO SENSORES> Ultima medicion de ph:' . $ph . ', porcentaje actual de agua en el tinaco: ' . $porcentaje . '</INFORMACION MODULO SENSORES>' // Agrega los datos de los sensores en formato JSON
                            ],
                            [
                                'text' => $promt
                            ],
                            [
                                'text' => 'me llamo ' . $user->name . ' ' . $text . "</FIN DEL PROMT>"
                            ]

                        ]
                    ]
                ]
            ];

            // Consumir el endpoint de Google Generative Language
            $response = Http::post('https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent?key=' . env('GEMINI_API_KEY'), $payload);

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
        } else {
            //si no se encuentra un broker asociado al usuario
            // Preparar el payload para enviar al API
            $payload = [
                'contents' => [
                    [
                        'parts' => [
                            [
                                'text' => $promt . 'SI NO VES DATOS DE SENSORES SIGNIFICA QUE NO HAY DATOS DISPONIBLES' . "</FIN DEL PROMT>"
                            ],
                            [
                                'text' => 'me llamo ' . $user->name . '. ' . $text . "</FIN DEL PROMT>"
                            ]

                        ]
                    ]
                ]
            ];

            // Consumir el endpoint de Google Generative Language
            $response = Http::post('https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent?key=AIzaSyC9sktdHFAUyJsoKuxql8bmbENCDvhBCi4', $payload);

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
}
