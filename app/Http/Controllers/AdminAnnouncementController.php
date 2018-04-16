<?php

namespace App\Http\Controllers;

use App\Announcement;
use App\AnnouncementUser;
use App\Group;
use App\Http\Requests\AnnouncementPostRequest;
use App\Http\Requests\AnnouncementUpdateRequest;
use App\Libraries\Helpers;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Cartalyst\Sentinel\Users\EloquentUser;
use Illuminate\Http\Request;

class AdminAnnouncementController extends Controller
{
    public function __construct()
    {
        Helpers::setCurrentPage('announcements');
    }
    public function index()
    {
        $announcements = Announcement::where('creator_id', Sentinel::getUser()->id)->get();
        $seq_num = 0;
        return view('admin.announcements.admin_announcement_index', compact('announcements', 'seq_num'));
    }

    public function show($id)
    {
        $announcement = Announcement::findOrFail($id);
        if ($announcement->creator_id != Sentinel::getUser()->id) {
            return abort(404, 'لا توجد صلاحية تعديل الإشعار');
        }
        return view('admin.announcements.admin_announcement_show', compact('announcement'));
    }

    public function create()
    {
        $users = EloquentUser::all();
        $groups = Group::all();
        return view('admin.announcements.admin_announcement_create', compact('users', 'groups'));
    }
    public function edit($id)
    {
        $announcement  = Announcement::findOrFail($id);
        if ($announcement->creator_id != Sentinel::getUser()->id) {
            return abort(404, 'لا توجد صلاحية تعديل الإشعار');
        }
        $groups = Group::all();
        $recipients = array_pluck($announcement->users, 'id');
        $users = EloquentUser::all();
        return view('admin.announcements.admin_announcement_edit', compact('announcement', 'groups', 'users', 'recipients', 'recipients'));
    }

    public function update(AnnouncementUpdateRequest $request, $id)
    {
        $user_id = Sentinel::getUser()->id;
        $announcement = Announcement::findOrFail($id);
        if ($announcement->creator->id != $user_id) {
            return abort(404, 'لا يحق  لك تعديل هذا الإشعار.');
        }

        $announcement->subject = $request->subject;
        $announcement->body = $request->body;

        if ($request->hasFile('attachment')) {
            $now = time() . '_';
            $document = $request->file('attachment');
            $destination = public_path('files_announcements/');
            $file_name = $now . $document->getClientOriginalName();
            if ($document->move($destination, $file_name)) {
                $announcement->attachment = $file_name;
            }
        }
        $announcement->save();

        foreach ($announcement->users as $user) {
            $announcement->users()->detach($user);
        }

        //fist recipient deleted first then make new recipient list based on new recipients;
        if (count($request->recipients) > 0) {
            foreach ($request->recipients as $recipient) {
                if ($recipient != '' ) {
                    $announcement_user = new AnnouncementUser();
                    $announcement_user->announcement_id = $announcement->id;
                    $announcement_user->user_id = $recipient;
                    $announcement_user->save();
                }
            }
        }
        Toastr::success('تم حفظ الإشعارات!', 'الإشعارات');
        return redirect(url('admin/announcements', $announcement->id));

    }


    public function store(AnnouncementPostRequest $request)
    {
        $array_hijri = explode('/ ', $request->input('hijri_created'));

        $user_id = Sentinel::getUser()->id;
        $announcement = new Announcement();
        $announcement->creator_id = $user_id;
        $announcement->hijri_created_day = $array_hijri[0];
        $announcement->hijri_created_month = $array_hijri[1];
        $announcement->hijri_created_year = $array_hijri[2];
        $announcement->subject = $request->subject;
        $announcement->body = $request->body;

        if ($request->hasFile('attachment')) {
            $now = time() . '_';
            $document = $request->file('attachment');
            $destination = public_path('files_announcements/');
            $file_name = $now . $document->getClientOriginalName();
            if ($document->move($destination, $file_name)) {
                $announcement->attachment = $file_name;
            }
        }

        $announcement->save();

        if (count($request->recipients) > 0) {
            foreach ($request->recipients as $recipient) {
                //if recipient id null, ignore it
                if ($recipient != '' ) {
                    $announcement_user = new AnnouncementUser();
                    $announcement_user->announcement_id = $announcement->id;
                    $announcement_user->user_id = $recipient;
                    $announcement_user->save();
                }
            }
        }
        Toastr::success('تم إنشاء الإشعارات!', 'الإشعارات');
        return redirect(url('admin/announcements'));
    }

}
