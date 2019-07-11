<?php

use Illuminate\Database\Seeder;
use App\Models\Relation_rol_permission;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;

class RelationRolPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //se trunca la tabla
        Relation_rol_permission::truncate();

        //se obtienen los datos del archivo correspondiente y se parsean
        $json = File::get('database/data/relation_rol_permission.json');
        $permisos = json_decode($json);

        foreach ($permisos as $permiso){
            Relation_rol_permission::create([
                'rol_id' => $permiso->rol_id,
                'permission_id' => $permiso->permission_id,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }
}
