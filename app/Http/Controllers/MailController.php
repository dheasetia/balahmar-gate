<?php

namespace App\Http\Controllers;

use Abuhamidah\Mobily\Mobily;
use App\Announcement;
use App\Libraries\Helpers;
use App\Mail\UserActivation;
use Brian2694\Toastr\Facades\Toastr;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use App\Notification;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function testEmail()
    {
        $user = Sentinel::findById(1);
        Mail::to($user)->send(new UserActivation($user));
        return 'Email sent at: ' . date('H:i:s', time());
    }

    public function testSMS(Request $request)
    {
        return Mobily::sendSMS('Balhamer', ['0503400178'], 'Hello Abah');
    }

    public function testToastr()
    {
        Toastr::success('Messages in here', 'Title', ["positionClass" => "toast-top-center"]);
        return view('welcome');
    }

    public function testNotification()
    {
        return Helpers::currentUserTotalUnreadAnnouncements();
    }
}
