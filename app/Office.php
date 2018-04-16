<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    protected $fillable = [
        'name',
        'description',
        'advisor_id',
        'manager_name',
        'license_date',
        'bank_id',
        'iban',
        'representative',
        'mobile',
        'phone',
        'second_phone',
        'fax',
        'email',
        'website',
        'logo',
        'area_id',
        'city_id',
        'street',
        'district',
        'building_no',
        'additional_no',
        'po_box',
        'zip_code',
        'coordinate'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function advisor()
    {
        return $this->belongsTo('App\Advisor');
    }

    public function bank()
    {
        return $this->belongsTo('App\Bank');
    }

    public function area()
    {
        return $this->belongsTo('App\Area');
    }

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function getApprovalStatusAttribute()
    {
        if ($this->is_approved == 0) {
            return '<span class="label label-sm label-danger"> لم تتم </span>';
        } else {
            return '<span class="label label-sm label-success"> تمت </span>';
        }
    }

    public function proposals()
    {
        return $this->hasMany('App\proposal');
    }

    public function projects()
    {
        return $this->hasMany('App\Project');
    }
}
