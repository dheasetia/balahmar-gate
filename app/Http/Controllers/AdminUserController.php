<?php

namespace App\Http\Controllers;

use App\Announcement;
use App\AnnouncementUser;
use App\GroupUser;
use App\Libraries\Helpers;
use App\Message;
use App\MessageRecipient;
use App\Office;
use App\Project;
use App\ProjectApproval;
use App\Proposal;
use App\Report;
use App\Role;
use App\RoleUser;
use App\Sms;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Cartalyst\Sentinel\Users\EloquentUser;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminUserController extends Controller
{
    public function __construct()
    {
        Helpers::setCurrentPage('admin-users-users');
        $this->middleware('admin');
    }

    public function index()
    {
        $users = EloquentUser::where('id', '<>', Sentinel::getUser()->id)->get();
        $seq_num = 0;
        return view('admin.users.admin_user_index', compact('users', 'seq_num'));
    }

    public function show($id)
    {
        $user = EloquentUser::findOrFail($id);
        $roles = Role::all();

        return view('admin.users.admin_user_show', compact('user', 'roles'));
    }

    public function assign(Request $request)
    {

        $user = Sentinel::findById($request->user_id);

        $role = Sentinel::findRoleById($request->role);

        $role_user = RoleUser::where('user_id', $user->id)->first();

        if (count($role_user) > 0) {
            DB::table('role_users')->where('user_id', $user->id)->delete();
        }

        $role->users()->attach($user);

        if ($request->role == 1) {
            Toastr::success('تم تعيين صلاحية الأدمن للمستخدم ' . $user->name, 'تعيين صلاحية مستخدم');
        } else if ($request->role == 2) {
            Toastr::success('تم تعيين صلاحية العادي للمستخدم ' . $user->name, 'تعيين صلاحية مستخدم');
        }

        return redirect(url('admin/users', $user->id));

    }

    public function destroy($id)
    {
        $user = Sentinel::findById($id);

        if (count($user) != 1) {
            Toastr::error('تعذر البرنامج من حذف المستخدم: ' . '<strong>' . $user->name . '</strong>', 'خذف المستخدم');
            return redirect()->back();
        }

        if ($user->inRole('admin')) {
            Toastr::error('تعذر البرنامج من حذف المستخدم: ' . '<strong>' . $user->name . '</strong>', 'خذف المستخدم');
            return redirect()->back();
        }

        $reports = Report::where('user_id', $id)->get();
        foreach ($reports as $report) {
            $report->delete();
        }


        $office = Office::where('user_id', $id)->first();
        if (count($office) > 0) {
            $office->delete();
        }

        $projects = Project::where('user_id', $id)->get();
        foreach ($projects as $project) {
            $project->delete();
        }

        $messages = Message::where('creator_id', $id)->get();
        foreach ($messages as $pesan) {
            $pesan->delete();
        }

        $announcement_user = AnnouncementUser::where('user_id', $id)->get();
        foreach ($announcement_user as $announcement) {
            $announcement->delete();
        }

        $announcements = Announcement::where('creator_id', $id)->get();
        foreach ($announcements as $announcement) {
            $announcement->delete();
        }

        $group_user = GroupUser::where('user_id', $id)->get();
        foreach ($group_user as $user) {
            $user->delete();
        }

        $message_recipients = MessageRecipient::where('recipient_id', $id)->get();
        foreach ($message_recipients as $message_recipient) {
            $message_recipient->delete();
        }

        $project_approvals = ProjectApproval::where('user_id', $id)->get();
        foreach ($project_approvals as $approval) {
            $approval->delete();
        }

        $sms = Sms::where('creator_id', $id)->get();
        foreach ($sms as $text) {
            $text->delete();
        }

        $user->delete();

        Toastr::success('تم حذف المستخدم: ' . '<strong>' . $user->name . '</strong> مع الجهة التابعة له.', 'خذف المستخدم');
        return redirect('/admin/users');
    }
}
