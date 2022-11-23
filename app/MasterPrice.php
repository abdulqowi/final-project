<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterPrice extends Model
{
    protected $table = 'master_prices';   
    protected $guarded = [];
    public function user(){
        $this->hasOne(User::class);
    }
}
