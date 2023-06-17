<?php

namespace Database\Seeders;

use App\Models\Configuracion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfiguracionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $configuracion = Configuracion::create([
            'nombre_sistema' => 'Mascotas Inc',
            'color_principal' => '#2374ab',
            'logo' => 'logo_mascota_inc.jpg',
            'favicon' => 'favicon_mascota.png',
            'color_iconos_sidebar' => '#7794a5',
            'color_iconos_cards' => '#103354',
            'color_boton_add' => '#103354',
            'color_boton_save' => '#3e5664',
            'color_boton_close' => '#1c1c1c',
        ]);
    }
}
