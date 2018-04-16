<?php

namespace App\Http\Controllers;

use Abuhamidah\Mobily\Mobily;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Mail\UserActivation;
use Brian2694\Toastr\Facades\Toastr;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Cartalyst\Sentinel\Users\EloquentUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('user');
        $this->middleware('active')->except([
            'registered',
            'needActivation',
            'sendActivation'
        ]);
    }

    public function index()
    {
        if (!Sentinel::getUser()->has('office')) {
            return redirect('/office/create');
        }
        return view('user.user_dashboard');
    }

    public function edit()
    {
        $user = Sentinel::getUser();
        return view('user.user_edit', compact('user'));
    }

    public function update(UserUpdateRequest $request)
    {
        $user = Sentinel::getUser();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->national_id = $request->national_id;

        if ($request->password != '') {
            $user->password = bcrypt($request->password);
        }

        if($request->hasFile('avatar')){
            $now = time() . '_';
            $document = $request->file('avatar');
            $destination_path = public_path('files_avatars');

            $file_name = $now . $document->getClientOriginalName();
            if($document->move($destination_path, $file_name)){
                $user->avatar = $file_name;
            }
        }

        $user->save();
        flash('بيانات مستخدم', 'تم حفظ بيانات المستخدم', 'success');
        return redirect('/user/edit');
    }

    public function registered()
    {
        return view('authentication.registered');
    }

    public function banned()
    {
        return view('authentication.banned');
    }

    public function needActivation()
    {
        return view('user.need_activation', compact('user'));
    }

    public function sendActivation()
    {
        $user = Sentinel::getUser();
        $token = str_random(64);
        $otp = rand(1001, 9999);
        $user->otp = $otp;
        $user->token = $token;
        $user->throttle_number = 1;
        $user->save();
        Mail::to($user)->send(new UserActivation($user));
        return view('user.activation_email_sent');
    }

    public function update_password(UpdatePasswordRequest $request)
    {
        $user = Sentinel::getUser();
        $user->password = bcrypt($request->password);
        $user->save();
        Toastr::success('تم تحديث كلمة المرور الخاصة بك', 'تحديث كلمة المرور');
        return redirect('/');
    }
}
