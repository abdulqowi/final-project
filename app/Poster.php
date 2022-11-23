<?php

namespace App;

use Illuminate\Support\Facades\URL;
use Illuminate\Database\Eloquent\Model;

class Poster extends Model
{
    protected $guarded = [];
    public function user(){
        $this->belongsTo(User::class);
    }
}
