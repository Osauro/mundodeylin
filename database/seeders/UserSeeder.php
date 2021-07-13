<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'                  => 'Nagato',
            'email'                 => 'acxel.q17@gmail.com',
            'password'              => Hash::make('123456789'),
            'email_verified_at'     => now(),
            'dni'                   => '6170125',
            'celular'               => '73010688',
            'direccion'             => 'Zona Villa Caluyo Av. 9 N° 206',
            'tipo'                  => 'Administrador',
            'profile_photo_path'    => 'https://ui-avatars.com/api/?name=Nagato&color=7F9CF5&background=EBF4FF'
        ]);
    }
}
