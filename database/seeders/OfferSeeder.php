<?php

namespace Database\Seeders;

use App\Models\Section;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        foreach (range(1, 100) as $index) {
            $title = $faker->unique()->sentence(4, true);
            $published = rand(0, 1);
            $published_at = $published ? $faker->dateTimeBetween('-1 years', 'now', null) : null;
            $user = User::inRandomOrder()->first();
            $section = Section::inRandomOrder()->first();

            DB::table('offers')->insert([
                'title' => $title,
                'slug' => Str::slug($title, '-'),
                'published_at' => $published_at,
                'published' => $published,
                'introduction' => $faker->text(),
                'description' => $faker->text(),
                'authour_id' => $user->id,
                'section_id' => $section->id,
            ]);
        }
    }
}
