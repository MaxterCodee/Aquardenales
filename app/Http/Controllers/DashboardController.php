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
        $brokers = Broker::where('user_id', $user->id)->first();
        $broker = $brokers;
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
        //data broker
        $brokerName = $broker->name;

        //obtener ultima medicion "Ultima actualizacion hace $'tiempo'"
        $time = $lastDataBroker->time;
        $date = $lastDataBroker->date;
        $timeUpdate = Carbon::parse($date . ' ' . $time)->diffForHumans();
        //quitar 'en'
        $timeUpdate = str_replace('en ', '', $timeUpdate);




        // Obtener la fecha actual
        $now = Carbon::now();

        // Obtener los últimos 4 meses (formato "F Y", por ejemplo "September 2023")
        $labels1 = [];
        for ($i = 3; $i >= 0; $i--) {
            $labels1[] = $now->copy()->subMonthsNoOverflow($i)->format('F Y');
        }

        // Obtener los datos de consumo por mes
        $data = $lastDataBroker::select(
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


        $broker = Broker::all();

        return view('dashboard', compact(
            'brokerName',
            'porcentaje',
            'litrosGastados',
            'ph',
            'timeUpdate',
            'labels1',
            'consumptionData',

        ));
    }
}
