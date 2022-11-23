<?php

use App\Course;
use App\Receipt;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for     ($i = 0; $i <5; $i++){
            $id= Course::InsertGetId([
                'course_name' =>Str::random(6),
                'total_price' =>rand(100000,10000000),
                'created_at' =>date('Y-m-d H:i:s'),
            ]);
        };
    }
}
