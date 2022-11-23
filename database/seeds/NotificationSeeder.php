<?php

use Carbon\Carbon;
use Faker\Factory;
use App\Notification;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        for     ($i = 0; $i < 5 ; $i++) {
            Notification::create ([
                'notification' => $faker-> text,
                'Time' => Carbon::now()->toDayDateTimeString(),
            ]);
        };
    }
}
