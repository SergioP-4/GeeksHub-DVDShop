<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

//Spatie
use Spatie\Permission\Models\Permission;

class SeederTablePermisos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){

       /* $permisos = [
            'ver-rol',
            'crear-rol',
            'editar-rol',
            'borrar-rol',
            'ver-film',
            'crear-film',
            'editar-film',
            'borrar-film',
        ];*/
        $permisos = [
            'ver-user',
            'crear-user',
            'editar-user',
            'borrar-user',
        ];

        foreach ($permisos as $permiso){
            Permission::create(['name' => $permiso]);
        }
    }
}
