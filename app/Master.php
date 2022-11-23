<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Master extends Model
{   
    protected $guarded = [];
    public function user(){
        $this->belongsTo(User::class);
    }
}
