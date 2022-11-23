<?php

namespace App;

use App\Master;
use App\UserDetail;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = [];
    public function detail(){
        $this->hasMany(UserDetail::class, 'user_id');
    }

    // public function user(){
    //     $this->hasOne(User::class);
    // }

        
}

