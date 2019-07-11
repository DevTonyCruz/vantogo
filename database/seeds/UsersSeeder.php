<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\File;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //se trunca la tabla
        User::truncate();

        //se obtienen los datos del archivo correspondiente y se parsean
        $json = File::get('database/data/users.json');
        $users = json_decode($json);

        foreach ($users as $user) {
            User::create([
                'name' => $user->name,
                'rol_id' => $user->rol_id,
                'email' => $user->email,
                'password' => bcrypt($user->password),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);

        }

        //factory(User::class, 100)->create();
    }
}
