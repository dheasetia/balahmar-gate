<?php

namespace App;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\AnnouncementUser;

class Announcement extends Model
{
    public function getIsReadAttribute()
    {
        $temp = DB::select(DB::raw('SELECT is_read FROM announcement_user WHERE user_id ' . $this->user_id . ' AND announcement_id = ' . $this->id));
        $result = $temp[0]->is_read;
        if ($result == 0) {
            return false;
        } else {
            return true;
        }
    }
    public function creator()
    {
        return $this->belongsTo('App\User', 'creator_id');
    }

    public function getIsFavouriteAttribute()
    {
        $temp = DB::select(DB::raw('SELECT is_favourite FROM announcement_user WHERE user_id ' . $this->user_id . ' AND announcement_id = ' . $this->id));
        $result = $temp[0]->is_favourite;
        if ($result == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function getDetailAttribute()
    {
        return AnnouncementUser::where('announcement_id', $this->id)->where('user_id', Sentinel::getUser()->id)->first();
    }
}
