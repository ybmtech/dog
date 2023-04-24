<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $create_date=date('Y-m-d H:i:s');
        $categories=['German Shepherd','Rottweiler','Caucasian','Lhasa'];
        foreach($categories as $category):
            DB::table('categories')->insert([
                'name' => $category,
                'created_at' => $create_date,
                'updated_at' => $create_date,
            ]);    endforeach;
    }
}
