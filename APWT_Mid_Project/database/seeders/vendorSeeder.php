<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class vendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<10;$i++){
            DB::table('vendors')->insert([
                'v_username' => Str::random(10),
                'v_name' => Str::random(10),
                'v_email' => Str::random(10).'@gmail.com',
                'v_phone' => 1630406235,
                'v_password' => Hash::make('password'),
                'v_gender' => 'Male',
                'v_dob' => "1999-12-26",
                'v_address' => Str::random(10),
                'v_propic'=>"",
            ]);
        }
    }
}
