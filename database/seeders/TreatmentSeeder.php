<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TreatmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $x = 14;
        for($i = 1 ; $i <12;$i++){
            DB::table('treatments')->insert([
                'external_id' => rand(1,9999),
                'dentist_id' => $i,
                'patient_id' => $x,
                'plates' => rand(1,36),
                'ended_at' =>  Carbon::today()->subDays(rand(0, 365)),
                'created_at' => Carbon::today()->subDays(rand(0, 365)),
                'updated_at' => Carbon::today()->subDays(rand(0, 365))
            ]);
            if($x > 1){
                $x--;
            }
        }
    }
}
