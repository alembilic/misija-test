<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1, 100) as $index) {
            $name = 'Section ' . $index; //Nisam nista bolje mogao smisliti :)

            DB::table('sections')->insert([
                'name' => $name,
                'slug' => Str::slug($name, '-'),
                'published' => rand(0, 1),
                'is_on_front' => rand(0, 1),
                'order' => 1 //Ne znam sta predstavlja order
            ]);
        }
    }
}
