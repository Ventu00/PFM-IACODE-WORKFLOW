<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Datos de prueba del laboratorio (ver capítulo 4, apartado 4.4).
     *
     * IMPORTANTE: estos datos deben ser SIEMPRE los mismos en las 16
     * versiones de código que se prueben, para que la comparación entre
     * ellas sea justa. No los cambies a mitad del experimento.
     *
     * TODO: cuando tengas el módulo de Autenticación generado, crea aquí
     * 1-2 usuarios de prueba fijos (mismo email/contraseña siempre) con
     * User::factory() o User::create([...]).
     *
     * TODO: cuando tengas el módulo de Búsqueda/listado generado, crea
     * aquí unos cuantos registros de ejemplo (p. ej. 10 "productos") sobre
     * los que las pruebas de búsqueda y de OWASP ZAP puedan actuar.
     */
    public function run(): void
    {
        // Ejemplo de estructura a seguir una vez exista el modelo User:
        //
        // \App\Models\User::factory()->create([
        //     'name' => 'Usuario Prueba',
        //     'email' => 'prueba@laboratorio.test',
        //     'password' => bcrypt('Password123!'),
        // ]);
    }
}
