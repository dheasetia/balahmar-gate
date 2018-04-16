<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupUser extends Model
{
    protected $table = 'group_user';

    public function user()
    {
        return $this->hasOne('App\User');
    }

    public function group()
    {
        return $this->hasOne('App\Group');
    }
}
