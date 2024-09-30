<?php

namespace Database\Seeders;

use App\Models\DataBroker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DataBrokerSeeder extends Seeder
{
    public function run(): void
    {
        $data = [];
        $brokerId = 1;

        for ($i = 0; $i < 5; $i++) {
            $data[] = [
                'ph' => mt_rand(60, 90) / 10, // Genera un pH entre 6.0 y 9.0
                'distance_cm' => rand(10, 100), // Distancia aleatoria en cm
                'liters_min' => rand(1, 10), // Litros por minuto
                'date' => Carbon::create(2024, 9, 30),
                'time' => Carbon::createFromTime(rand(0, 23), rand(0, 59)),
                'broker_id' => $brokerId,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        for ($i = 0; $i < 5; $i++) {
            $data[] = [
                'ph' => mt_rand(60, 90) / 10,
                'distance_cm' => rand(10, 100),
                'liters_min' => rand(1, 10),
                'date' => Carbon::create(2024, 9, 31),
                'time' => Carbon::createFromTime(rand(0, 23), rand(0, 59)),
                'broker_id' => $brokerId,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('data_brokers')->insert($data);

        // Fecha y hora actuales
        $now = Carbon::now();
        $date = $now->format('Y-m-d');

        // Crear 7 registros
        for ($i = 0; $i < 7; $i++) {
            DataBroker::create([
                'ph' => rand(0, 14), // Asumiendo que el pH puede variar de 0 a 14
                'liters_min' => rand(1, 100), // Líneas de ejemplo para litros por minuto
                'distance_cm' => rand(10, 100), // Distancia aleatoria en centímetros
                'date' => $date,
                'time' => $now->copy()->addHours($i)->format('H:i:s'), // Hora incrementada en i horas
                'broker_id' => 1,
            ]);
        }
    }
}
