<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $dates = [
        'report_from',
        'report_to'
    ];

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function pictures()
    {
        return $this->hasMany('App\ReportPicture');
    }

    public function getHijriCreatedAttribute()
    {
        return str_pad($this->hijri_created_day, 2, '0', STR_PAD_LEFT) . '/ ' . str_pad($this->hijri_created_month, 2, '0', STR_PAD_LEFT) . '/ ' . $this->hijri_created_year;
    }

    public function getHijriReportFromAttribute()
    {
        return str_pad($this->hijri_report_from_day, 2, '0', STR_PAD_LEFT) . '/ ' . str_pad($this->hijri_report_from_month, 2, '0', STR_PAD_LEFT) . '/ ' . $this->hijri_report_from_year;
    }

    public function getHijriReportToAttribute()
    {
        return str_pad($this->hijri_report_to_day, 2, '0', STR_PAD_LEFT) . '/ ' . str_pad($this->hijri_report_to_month, 2, '0', STR_PAD_LEFT) . '/ ' . $this->hijri_report_to_year;
    }

}
