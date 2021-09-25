<?php

use Illuminate\Database\Seeder;

class RegistrationFeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bases = \App\EducationalBase::all();

        foreach ($bases as $base){
            \App\RegistrationFee::create([
                'base_id'=>$base->id,
                'status'=>1,
                'cost'=>"1000",
                'desc'=>" "
            ]);
        }
    }
}
