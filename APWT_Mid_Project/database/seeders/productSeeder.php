<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class productSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<50;$i++){
            DB::table('products')->insert([
                'name' => "Pure Pure Salt",
                'category' => "Cooking",
                'thumbnail' => "ACI Pure Salt.jpg",
                // 'gallery' => "null",
                'price' => 120,
                'stock' => 100,
                'size' => 10,
                'v_id' => 1,
                'description' => "Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium.",
            ]);
        }
    }
}
