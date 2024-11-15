<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Broker;
use App\Models\DataBroker;
use Illuminate\Support\Facades\Hash;

class UserBrokerDataBrokerSeeder extends Seeder
{
    public function run()
    {
        // Crear 3 usuarios con correos y contraseñas especificadas
        $users = [
            [
                'name' => 'Usuario 1',
                'email' => 'usuario1@example.com',
                'password' => 'password123',
            ],
            [
                'name' => 'Usuario 2',
                'email' => 'usuario2@example.com',
                'password' => 'password123',
            ],
            [
                'name' => 'Usuario 3',
                'email' => 'usuario3@example.com',
                'password' => 'password123',
            ],
        ];

        foreach ($users as $userData) {
            // Crear el usuario
            $user = User::create($userData);

            // Crear un broker para cada usuario con un valor único para `serial`
            $broker = Broker::create([
                'name' => 'Broker for ' . $user->name,
                'serial' => 'BR-' . uniqid(), // Genera un serial único
                'habitants' => rand(1, 5),
                'depth_cm' => rand(100, 500),
                'liter_capacity' => rand(1000, 5000),
                'user_id' => $user->id,
            ]);

            // Crear 15 registros en databroker para cada broker
            for ($i = 0; $i < 15; $i++) {
                DataBroker::create([
                    'ph' => rand(6, 8) + (rand(0, 100) / 100),
                    'liters_min' => rand(10, 50),
                    'distance_cm' => rand(1, 100),
                    'date' => now()->subDays(rand(0, 30))->toDateString(),
                    'time' => now()->subMinutes(rand(0, 1440))->format('H:i:s'),
                    'broker_id' => $broker->id,
                ]);
            }
        }
    }
}
