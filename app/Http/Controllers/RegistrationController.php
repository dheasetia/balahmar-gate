<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgottenEmailPostRequest;
use App\Libraries\Helpers;
use App\Mail\ForgetPassword;
use App\Role;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterPostRequest;
use Cartalyst\Sentinel\Users\EloquentUser;
use Abuhamidah\Mobily\Mobily;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserActivation;

class RegistrationController extends Controller
{
    public function register()
    {
        Helpers::setCurrentPage('register');
        return view('authentication.register');
    }

    public function postRegister(RegisterPostRequest $request)
    {
        $token = str_random(64);
        $request['token'] = $token;
        $user = Sentinel::registerAndActivate($request->all(), true);
        $user_role = Sentinel::findRoleBySlug('user');
        $user_role->users()->attach($user);
        Sentinel::login($user);
        Mail::to($user)->send(new UserActivation($user));
        flash('تسجيل', 'تم تسجيل عضويتك بالبوابة،', 'success');
        return redirect('/registered');
    }

    public function getActivate(Request $request)
    {
        $token = $request->token;
        $email = $request->email;
        $otp = rand(1001, 9999);
        $user = EloquentUser::where('token', $token)->where('email', $email)->first();
        if (count($user) == 0) {
            return abort(404, 'Wrong token');
        }
        if ($user->is_active == 1) {
            Toastr::success('تم تفعيل حسابك', 'تفعيل الحساب');
            Sentinel::login($user);
            return redirect('/');
        }
        $throttle_number = intval($user->throttle_number) + 1;
        if ($throttle_number > 5) {
            Sentinel::logout();
            return view('authentication.throttle_over');
        }
        $user->throttle_number = $throttle_number;
        $user->otp = $otp;
        $user->save();
        Mobily::sendSMS('BalhmarChar', [$user->mobile], 'رمز التفعيل: ' . PHP_EOL . $user->otp);
        return view('authentication.activate', compact('token', 'email'));
    }

    public function postActivate(Request $request)
    {
        $user = EloquentUser::where('email', $request->email)->where('token', $request->token)->where('otp', $request->otp)->first();
        if (count($user) == 0) {
            return redirect()->back()->with('error', 'الرقم غير صحيح.');
        }
        $user->token = '';
        $user->otp = '';
        $user->throttle_number = 0;
        $user->is_active = 1;
        $user->save();
        Sentinel::login($user);
        flash('تفعيل الحساب', 'تم تفعيل حسابك بنجاح', 'success');
        return redirect('/');
    }

    public function forget_password()
    {
        return view('authentication.forget_form');
    }

    public function check_forgotten_email(ForgottenEmailPostRequest $request)
    {
        $email = $request->forgotten_email;
        $user = Sentinel::findByCredentials([
            'email' => $email
        ]);
        if ($user) {
            $token = str_random(64);
            $user->token = $token;
            $user->save();
            Mail::to($user)->send(new ForgetPassword($user));
            return view('authentication.after_send_email');
        }
        return redirect()->back()->with('message', 'البريد الإلكتروني غير مسجل')->withInput();
    }

    public function reset_password(Request $request)
    {
        $token = $request->token;
        $email = $request->email;
        $user = EloquentUser::where('email', $email)->where('token', $token)->first();

        if (count($user) > 0) {
            $otp = rand(1001, 9999);
            $throttle_number = intval($user->throttle_number) + 1;
            if ($throttle_number > 5) {
                $carbon_now = Carbon::now();
                if ($carbon_now->diffInHours($user->updated_at) < 1) {
                    Sentinel::logout();
                    return view('authentication.reset_password_throttle_over');
                }
                $user->throttle_number = 0;
            }
            $user->throttle_number = $throttle_number;
            $user->otp = $otp;
            $user->save();
            if (Mobily::sendSMS('BalhmarChar', [$user->mobile], 'الرمز المؤقت: ' . PHP_EOL . $user->otp) == '1') {
                return view('authentication.sms_sent', compact('token', 'email'));
            } else {
                return view('authentication.sms_unable_to_sent');
            }
        }
        return abort(404);
    }

    public function post_reset_password(Request $request)
    {
        $token = $request->token;
        $email = $request->email;
        $user = EloquentUser::where('token', $token)->where('email', $email)->where('otp', $request->otp)->first();
        if (count($user) == 1 ) {
            $user->token = '';
            $user->otp = '';
            $user->save();
            Sentinel::login($user);
        } else {
            $message = 'الرمز المرسل غير صحيح';
            return view('authentication.sms_sent', compact('token', 'email', 'message'));
        }
        return view('user.new_password');
    }

}
