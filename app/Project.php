<?php

namespace App;

use App\Libraries\ArabicNumber;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function office()
    {
        return $this->belongsTo('App\Office');
    }

    public function kind()
    {
        return $this->belongsTo('App\Kind');
    }

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function reports()
    {
        return $this->hasMany('App\Report');
    }

    public function receipt()
    {
        return $this->hasMany('App\Receipt');
    }
    public function other_project_donated()
    {
        return $this->hasOne('App\Project', 'id', 'other_project_donated_id');
    }

    public function getHijriExecutedAttribute()
    {
        return $this->hijri_execution_day . '/ ' . $this->hijri_execution_month . '/ '  .$this->hijri_execution_year;
    }

    /*approval status =>
        0 = waiting approval,
        1. partially approved,
        2. denied,
        3. fully approved,
        4. denied sufficiently with prior donations (denied but approved on previous projects,
        5. pended (with pending_reason),
        6. requested (with requested_detail)
    */
    public function getStatusClassAttribute()
    {
        switch ($this->approval_status) {
            case '0':
                $result = 'warning';
                break;
            case '1':
                $result = 'success';
                break;
            case '2':
                $result = 'danger';
                break;
            case '3':
                $result = 'success';
                break;

            case '4':
                $result = 'danger';
                break;
            case '5':
                $result = 'danger';
                break;
            case '6':
                $result = 'danger';
                break;

            default:
                $result = 'default';
                break;
        }
        return $result;
    }

    public function getStatusAttribute()
    {
        switch ($this->approval_status) {
            case '0':
                $result = 'انتظار';
                break;
            case '1':
                $result = 'اعتمد';
                break;
            case '2':
                $result = 'اعتذار';
                break;
            case '3':
                $result = 'اعتمد';
                break;
            case '4':
                $result = 'اكتفاء';
                break;
            case '5':
                $result = 'مؤجل';
                break;
            case '6':
                $result = 'طلب';
                break;

            default:
                $result = 'لا يعرف';
                break;
        }
        return $result;
    }


    public function getHijriCreatedAttribute()
    {
        return $this->hijri_created_day . '/ ' . $this->hijri_created_month . '/ ' . $this->hijri_created_year;
    }

    public function getHijriApprovalAttribute()
    {
        if ($this->approval_status == 1) {
            return $this->hijri_approval_day . '/ ' . $this->hijri_approval_month . '/ ' . $this->hijri_approval_year;
        }
        return null;
    }

    public function getDonationApprovedInWordsAttribute()
    {
        $number = new ArabicNumber();
        if ($this->donation_approved != '') {
            return $number->int2str($this->donation_approved);
        }
        return '';
    }

    public function getDonationRequestedInWordsAttribute()
    {
        $number = new ArabicNumber();
        if ($this->donation_requested != '') {
            return $number->int2str($this->donation_requested);
        }
        return '';
    }


}
