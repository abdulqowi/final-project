<?php



use App\User;
use App\Receipt;
use App\UserDetail;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insertGetId([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'),
            'role' => '1',
            'phone' => '08112345678',
        ]);
        UserDetail::create([
            'user_id' => '1',
            'address'       => Str ::random(10)
        ]);


        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 5; $i++) {
            $id = User::insertGetId([
                'name'      =>  $faker->name,
                'email'     =>  $faker->unique()->safeEmail,
                'password'  =>  Hash::make('password'),
                'phone' => Str::random(10),
                'created_at' => date('Y-m-d H:i:s')
            ]);

            UserDetail::create([
                'user_id' => $id,
                'address' => Str::random(10),
            ]);
        }
        Artisan::call('passport:install');
    }
}
