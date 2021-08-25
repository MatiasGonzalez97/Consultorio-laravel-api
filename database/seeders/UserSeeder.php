<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1 ; $i <15;$i++){
            DB::table('users')->insert([
                'name' => Str::random(10),
                'surname' => Str::random(11),
                'gender' => 'o',
                'email' => Str::random(10).'@gmail.com',
                'password' => bcrypt(Str::random(10)),
            ]);
        }
    }
}
