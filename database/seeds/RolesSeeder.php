<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Models\Roles;
use Illuminate\Support\Facades\File;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //se trunca la tabla
        Roles::truncate();

        //se obtienen los datos del archivo correspondiente y se parsean
        $json = File::get('database/data/roles.json');
        $roles = json_decode($json);

        foreach ($roles as $rol) {
            Roles::create([
                'name' => $rol->name,
                'description' => $rol->description,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }
}
