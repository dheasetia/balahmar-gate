<?php

namespace App\Http\Controllers;

use App\Announcement;
use App\AnnouncementUser;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Cartalyst\Sentinel\Users\EloquentUser;
use Illuminate\Http\Request;
use App\Libraries\Helpers;

class AnnouncementController extends Controller
{
    public function __construct()
    {
        Helpers::setCurrentPage('announcements');
    }

    public function index()
    {
        $announcements = Sentinel::getUser()->announcements;
        $seq_num = 0;
        return view('announcements.announcement_index', compact('announcements', 'seq_num'));
    }

    public function show($id)
    {
        $announcement = Announcement::findOrFail($id);
        $announcement_user = AnnouncementUser::where('announcement_id', $announcement->id)->where('user_id', Sentinel::getUser()->id)->first();
        $announcement_user->is_read = 1;
        $announcement_user->save();
        return view('announcements.announcement_show', compact('announcement'));
    }

    public function favourite($id)
    {
        $announcement_user = AnnouncementUser::where('announcement_id', $id)->where('user_id', Sentinel::getUser()->id)->first();
        if ($announcement_user->is_favourite == 0) {
            $announcement_user->is_favourite = 1;
        } else {
            $announcement_user->is_favourite = 0;
        }
        $announcement_user->save();
        return redirect(url('/announcements', $id));
    }

    public function unread()
    {
        $unread_announcements = Sentinel::getUser()->announcements()->where('is_read', 0)->get();
        return view('announcements.announcement_unread', compact('unread_announcements'));
    }
}
