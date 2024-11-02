<?php

namespace App\Http\Controllers;

use App\Models\Broker;
use Carbon\Carbon;
use IcehouseVentures\LaravelChartjs\Facades\Chartjs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();
        //broker del usuario
        $broker = Broker::where('user_id', $user->id)->first();

        // Verificar si hay broker asociado
        if (!$broker) {
            // Redirigir si no se encuentra un broker
            return redirect()->route('empty')->with('error', 'No se encontró un broker asociado al usuario.');
        }

        $dataBroker = $broker->data_brokers;

        // Verificar si data_brokers es null o está vacío
        if (!$dataBroker || $dataBroker->isEmpty()) {
            // Redirigir si no hay datos en data_brokers
            return redirect()->route('empty')->with('error', 'No se encontraron datos del broker.');
        }

        $lastDataBroker = $dataBroker->last();

        // Realizar los cálculos solo si se tiene data_brokers
        $brockerProfundidad = $broker->depth_cm;
        $capacidadLitros = $broker->liter_capacity;
        $sensorDistancia = $lastDataBroker->distance_cm;

        // Cálculo de la cantidad de litros
        $altura_agua = $brockerProfundidad - $sensorDistancia;
        $litros_aproximados = round(($altura_agua / $brockerProfundidad) * $capacidadLitros);

        // Cálculo porcentaje
        $porcentaje = round(($litros_aproximados / $capacidadLitros) * 100);

        // Calcular consumo de litros hoy
        $hoy = Carbon::today();
        $litrosGastados = $dataBroker
            ->whereDate('date', $hoy)
            ->sum('liters_min');

        $ph = $lastDataBroker->ph;
        $brokerName = $broker->name;

        // Obtener la última medición
        $time = $lastDataBroker->time;
        $date = $lastDataBroker->date;
        $timeUpdate = Carbon::parse($date . ' ' . $time)->diffForHumans();
        $timeUpdate = str_replace('en ', '', $timeUpdate);

        // Obtener la fecha actual
        $now = Carbon::now();

        // Obtener los últimos 4 meses (formato "F Y", por ejemplo "September 2023")
        $labels1 = [];
        for ($i = 3; $i >= 0; $i--) {
            $labels1[] = $now->copy()->subMonthsNoOverflow($i)->format('F Y');
        }

        // Obtener los datos de consumo por mes
        $data = $dataBroker::select(
            DB::raw('SUM(liters_min) as total_consumption'),
            DB::raw('DATE_FORMAT(date, "%Y-%m") as month')
        )
            ->where('date', '>=', Carbon::now()->subMonths(4)) // Últimos 4 meses
            ->groupBy('month')
            ->orderBy('month', 'ASC')
            ->get();

        // Crear un array con consumo por mes, inicialmente con valores en 0
        $consumptionData = array_fill(0, 4, 0);

        // Mapear los resultados al array de consumo
        foreach ($data as $item) {
            $monthIndex = array_search(Carbon::createFromFormat('Y-m', $item->month)->format('F Y'), $labels1);
            if ($monthIndex !== false) {
                $consumptionData[$monthIndex] = $item->total_consumption;
            }
        }

        return view('dashboard', compact(
            'brokerName',
            'porcentaje',
            'litrosGastados',
            'ph',
            'timeUpdate',
            'labels1',
            'consumptionData'
        ));
    }

    public function empty()
    {
        return view('empty');
    }

}
