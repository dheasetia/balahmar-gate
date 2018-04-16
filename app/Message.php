<?php

namespace App;

use App\Libraries\Helpers;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function recipients()
    {
        return $this->belongsToMany('App\User', 'message_recipient', 'message_id', 'recipient_id');
    }

    public function creator()
    {
        return $this->belongsTo('App\User', 'creator_id');
    }

    public function getIsInboxAttribute()
    {
        $my_id = Sentinel::getUser()->id;
        $detail = Helpers::getMessageRecipientDetail($my_id, $this->id);
        if ($detail) {
            return $detail->recipient_id == $my_id;
        }
        return false;
    }

    public function getIsOutboxAttribute()
    {
        if ($this->creator_id == Sentinel::getUser()->id) {
            return true;
        }
        return false;
    }


}
