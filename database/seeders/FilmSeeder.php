<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('film')->insert([
            'name' => 'Pulp Fiction',
                                  ]);
        DB::table('film')->insert([
            'name' => 'El padrino'
                                  ]);
        DB::table('film')->insert([
            'name' => 'La vida es bella'
                                  ]);
        DB::table('film')->insert([
            'name' => 'El club de la lucha'
                                  ]);
        DB::table('film')->insert([
            'name' => 'Cadena Perpetua'
                                  ]);
        DB::table('film')->insert([
            'name' => 'El padrino'
                                  ]);
        DB::table('film')->insert([
            'name' => 'La lista de Schindler'
                                  ]);
        DB::table('film')->insert([
            'name' => 'La naranja mecánica'
                                  ]);
        DB::table('film')->insert([
            'name' => 'Forrest Gump'
                                  ]);
        DB::table('film')->insert([
            'name' => 'Gladiator'
                                  ]);

    }
}
