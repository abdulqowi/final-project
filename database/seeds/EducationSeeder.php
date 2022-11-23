<?php

use App\Education;
use Faker\Factory;
use Illuminate\Database\Seeder;

class EducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for     ($i = 0; $i < 1000; $i++ ) {
            $faker = Factory::create();
            Education::create([
                'user_id' => '1',
                'title' => $faker -> title,
                'content' => $faker -> text,
                'image' =>$faker->imageUrl(100,70,'animals')
            ]);
        }
        
        
    }
}
