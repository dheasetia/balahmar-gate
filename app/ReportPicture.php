<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportPicture extends Model
{
    protected $table = 'report_pictures';

    public function report()
    {
        return $this->belongsTo('App\Report');
    }
}
