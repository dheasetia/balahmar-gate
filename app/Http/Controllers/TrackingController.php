<?php

namespace App\Http\Controllers;

use App\Libraries\Helpers;
use App\Tracking;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function __construct()
    {
        Helpers::setCurrentPage('trackings');
    }
    public function index()
    {
        $tracking = Tracking::all();
        return $tracking;
    }
}
