<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Broker;
use App\Models\DataBroker;
use Illuminate\Support\Facades\Hash;

class UserBrokerDataSeeder extends Seeder
{
    public function run()
    {
        // Crear un nuevo usuario
        $user = User::create([
            'name' => 'Maximiliano Perea',
            'email' => 'maximiliano@example.com',
            'password' => Hash::make('password123'), // Cambia la contraseña según tus necesidades
        ]);

        // Crear un broker asociado al usuario
        $broker = Broker::create([
            'name' => 'Broker 1',
            'serial' => 'SERIAL123',
            'habitants' => 100,
            'depth_cm' => 150,
            'liter_capacity' => 1000,
            'user_id' => $user->id,
        ]);

        // Crear varios registros de data_broker asociados al broker
        DataBroker::insert([
            [
                'ph' => 7.0,
                'liters_min' => 50,
                'distance_cm' => 20,
                'date' => now()->toDateString(),
                'time' => now()->toTimeString(),
                'broker_id' => $broker->id,
            ],
            [
                'ph' => 7.2,
                'liters_min' => 60,
                'distance_cm' => 25,
                'date' => now()->toDateString(),
                'time' => now()->toTimeString(),
                'broker_id' => $broker->id,
            ],
            [
                'ph' => 6.9,
                'liters_min' => 55,
                'distance_cm' => 30,
                'date' => now()->toDateString(),
                'time' => now()->toTimeString(),
                'broker_id' => $broker->id,
            ],
            // Agrega más registros si es necesario
        ]);
    }
}
