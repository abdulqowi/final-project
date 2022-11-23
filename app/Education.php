<?php

namespace App;

use App\User;
use Illuminate\Support\Facades\URL;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = 'educations';
    protected $guarded = [];
    public function user(){
        $this->belongsTo(User::class,'user_id');
    }
    public function getImagePathAttribute()
    {
        return URL::to('/') . '/assets/images/Register/' . $this->image;
    }
}
