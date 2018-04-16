<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    /*
        PROPOSAL STATUS: 
        0 -> Not Aaproved (waiting);
        1 -> Approved;
        2 -> Banned;
    */

    public function kind()
    {
        return $this->belongsTo('App\Kind');
    }

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function project()
    {
        return $this->hasOne('App\Project');
    }

    public function office()
    {
        return $this->belongsTo('App\Office');
    }

    public function getStatusButtonAttribute()
    {
        $result = '---';
        switch ($this->is_approved) {
            case '0':
                $result = '<span class="btn btn-sm btn-warning">انتظار</span>';
                break;
            case '1':
                $result = '<span class="btn btn-sm btn-success">تمت الموافقة</span>';
                break;
            case '2':
                $result = '<span class="btn btn-sm btn-danger">مرفوض</span>';

            default:
                $result = '<span class="btn btn-sm btn-info">لا يعرف</span>';
                break;
        }
        return $result;
    }
    
    public function getStatusAttribute()
    {
        $result = '---';
        switch ($this->is_approved) {
            case '0':
                $result = 'انتظار';
                break;
            case '1':
                $result = 'تمت الموافقة';
                break;
            case '2':
                $result = 'مرفوض';
                break;
            default:
                $result = 'لا يعرف';
                break;
        }
        return $result;
    }
    

    public function getStatusClassAttribute()
    {
        $result = 'default';
        switch ($this->is_approved) {
            case '0':
                $result = 'warning';
                break;
            case '1':
                $result = 'success';
                break;
            case '2':
                $result = 'danger';
                break;
            default:
                $result = 'default';
                break;
        }
        return $result;
    }

    public function getHijriCreatedAttribute()
    {
        return $this->hijri_created_day . '/ ' . $this->hijri_created_month . '/ ' . $this->hijri_created_year;
    }
}