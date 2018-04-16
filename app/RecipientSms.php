<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecipientSms extends Model
{
    protected $table = 'recipient_sms';

    public function recipient()
    {
        return $this->hasOne('App\User', 'id', 'recipient_id');
    }

    public function sms()
    {
        return $this->hasOne('App\Sms');
    }
}
