<?php

use Illuminate\Database\Seeder;
use App\Models\Pages;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Carbon;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //se trunca la tabla
        Pages::truncate();

        //se obtienen los datos del archivo correspondiente y se parsean
        $json = File::get('database/data/pages.json');
        $users = json_decode($json);

        foreach ($users as $user) {
            Pages::create([
                'name' => $user->name,
                'slug' => $user->slug,
                'length_text' => $user->length_text,
                'content' => $user->content,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);

        }
    }
}
