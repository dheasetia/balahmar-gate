<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    protected $fillable = [
        'project_id',
        'received_date',
        'receiver_name',
        'amount',
        'hijri_received_day',
        'hijri_received_month',
        'hijri_received_year',
        'description',
        'user_id',
        'document_path',
        'note'
    ];

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function getHijriReceivedAttribute()
    {
        return str_pad($this->hijri_received_day, 2, '0', STR_PAD_LEFT) . '/ ' . str_pad($this->hijri_received_month, 2, '0', STR_PAD_LEFT) . '/ ' . $this->hijri_received_year;
    }
}
