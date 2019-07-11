<?php

use Illuminate\Database\Seeder;
use App\Models\Configurations;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //se trunca la tabla
        Configurations::truncate();

        //se obtienen los datos del archivo correspondiente y se parsean
        $json = File::get('database/data/configuration.json');
        $configurations = json_decode($json);

        foreach ($configurations as $configuration) {
            Configurations::create([
                'key' => $configuration->key,
                'alias' => $configuration->alias,
                'value' => $configuration->value,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }
}
