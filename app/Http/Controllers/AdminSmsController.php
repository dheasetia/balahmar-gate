<?php

namespace App\Http\Controllers;

use Abuhamidah\Mobily\Mobily;
use App\Group;
use App\Http\Requests\SmsPostRequest;
use App\Libraries\Helpers;
use App\RecipientSms;
use App\Sms;
use Brian2694\Toastr\Facades\Toastr;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Cartalyst\Sentinel\Users\EloquentUser;
use Illuminate\Http\Request;

class AdminSmsController extends Controller
{
    public function __construct()
    {
        Helpers::setCurrentPage('sms');
    }

    public function index()
    {
        $sms = Sms::all();
        return view('admin.sms.admin_sms_index', compact('sms'));
    }

    public function create()
    {
        $groups = Group::all();
        $users = EloquentUser::all();
        if (Mobily::getSendStatus() != 'SUCCESS') {
            Toastr::error('يتعذر استخدام الرسالة الآن.', 'إرسال رسالة');
        }
        $res = Mobily::checkBalance();
        $credit_array = explode('/', $res);
        $credit = $credit_array[1];
        return view('admin.sms.admin_sms_create', compact('groups', 'users', 'credit'));
    }

    public function store(SmsPostRequest $request)
    {
        $array_hijri = explode('/ ', $request->input('hijri_created'));
        $user_id = Sentinel::getUser()->id;
        $sms_text = $request->text;

        $sms = new Sms();
        $sms->creator_id = $user_id;
        $sms->subject = $request->subject;
        $sms->text = $sms_text;
        $sms->hijri_created_day = $array_hijri[0];
        $sms->hijri_created_month = $array_hijri[1];
        $sms->hijri_created_year = $array_hijri[2];
        $sms->save();
        $sms_id = $sms->id;

        if (count($request->recipients) > 0) {
            foreach ($request->recipients as $recipient) {
                $recipient_sms = new RecipientSms();
                $recipient_sms->recipient_id = $recipient;
                $recipient_sms->sms_id = $sms_id;
                $user = EloquentUser::find($recipient);
                $status = Mobily::sendSMS('BalhmarChar', [$user->mobile], $sms_text);
                $recipient_sms->status = $status;
                $recipient_sms->save();
            }
        }
        redirect(url('admin/sms', $sms_id));
    }

    public function show($id)
    {
        $sms = Sms::findOrFail($id);
        $recipients = $sms->recipients;
        $sms_details = RecipientSms::where('sms_id', $sms->id)->get();
        return view('admin.sms.admin_sms_show', compact('sms', 'recipients', 'sms_details'));
    }
}
