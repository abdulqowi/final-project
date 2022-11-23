<?php

use App\Master;
use Illuminate\Database\Seeder;

class MasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Master::create([
            'user_id' => '1',
            'day' => 'Minggu',
        ]); 
    }
}
