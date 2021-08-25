<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DentistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 14 ; $i >1;$i--){
            DB::table('dentists')->insert([
                'user_id' => $i,
            ]);
        }
    }
}
