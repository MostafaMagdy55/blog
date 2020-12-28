<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use PhpParser\Builder\Function_;

class Profile extends Model
{
    protected $fillable=['about','youtube','facebook','avatar','user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }


    public function getAvatarAttribute($avatar)
    {
        return asset("uploads/avatars/". $avatar);
    }
}
