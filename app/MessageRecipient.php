<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessageRecipient extends Model
{
    protected $table = 'message_recipient';
    protected $dates = [
        'read_time'
    ];
}
