<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sms extends Model
{
    protected $table = 'sms';

    public function recipients()
    {
        return $this->belongsToMany('App\User', 'recipient_sms', 'sms_id', 'recipient_id');
    }

    public function creator()
    {
        return $this->belongsTo('App\User');
    }
}
