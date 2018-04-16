<?php
/**
 * Created by PhpStorm.
 * User: dheasetia
 * Date: 6/1/17
 * Time: 17:26
 */

namespace App\Libraries;

use App\Tracking;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class Track
{
    public static function insert($activity, $type = null, $notes = null)
    {
        $tracking = new Tracking();
        $tracking->user_id = Sentinel::getUser()->id;
        $tracking->ip = request()->ip();
        $tracking->activity = $activity;
        $tracking->type = $type;
        $tracking->notes = $notes;
        $tracking->save();
    }
}