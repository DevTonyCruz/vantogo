<?php

use Illuminate\Database\Seeder;
use App\Models\Permissions;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Carbon;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //se trunca la tabla
        Permissions::truncate();

        $archivos = File::allFiles('database/data/permissions');

        foreach($archivos as $archivo){
            $file = $archivo->getPathname();

            //se obtienen los datos del archivo correspondiente y se parsean
            $json = File::get($file);
            $modulos = json_decode($json);

            foreach ($modulos as $permisos) {
                foreach ($permisos->data as $permiso) {
                    Permissions::create([
                        'name' => $permiso->name,
                        'controller' => $permiso->controller,
                        'slug' => $permiso->slug,
                        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                    ]);
                }
            }
        }
    }
}
