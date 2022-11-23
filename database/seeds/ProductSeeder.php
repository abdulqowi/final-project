<?php

use App\ProductDetails;
use App\Receipt;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for     ($i = 0; $i <51; $i++){
            $id= ProductDetails::insertGetId([
                'product_list' =>rand(0,666),
                    'total_price' =>rand(1000,100000),
                'created_at' => date('Y-m-d H:i:s')
            ]);
        };
    }
}
