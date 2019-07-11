<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\Categories;
use Illuminate\Support\Carbon;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //se trunca la tabla
        Categories::truncate();

        //se obtienen los datos del archivo correspondiente y se parsean
        $json = File::get('database/data/categories.json');
        $categories = json_decode($json);

        foreach ($categories as $category) {
            Categories::create([
                'parent_id' => $category->parent_id,
                'name' => $category->name,
                'description' => $category->description,
                'photo_url' => "",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }
}
