<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class adminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<10;$i++){
            DB::table('admins')->insert([
                'a_username' => "admin",
                'a_name' => "Admin",
                'a_email' => "admin".'@gmail.com',
                'a_phone' => 1613594668,
                'a_password' => Hash::make('password'),
                'a_gender' => 'Male',
                'a_dob' => "01.11.1999",
                'a_address' => "Romna",
                'a_propic'=>"",
            ]);
        }
    }
}
