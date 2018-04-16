<?php

namespace App\Libraries;


use App\Office;
use App\Project;
use App\QuestionnaireAnswer;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\DB;
use App\MessageRecipient;

class Helpers {
    public static $current_page = 'dashboard';

    public static function getCurrentPage()
    {
        return self::$current_page;
    }

    public static function setCurrentPage($page)
    {
        return self::$current_page = $page;
    }

    public static function currentUserTotalUnreadAnnouncements()
    {
        $user = Sentinel::getUser();
        $unread_announcements = DB::select(DB::raw('SELECT COUNT(id) as total FROM announcement_user WHERE user_id = ' . $user->id . ' AND is_read = 0'));
        return $unread_announcements[0]->total;
    }

    public static function currentUserTotalUnreadMessages()
    {
        $user = Sentinel::getUser();
        $unread_messages = DB::select(DB::raw('SELECT COUNT(id) as total FROM message_recipient WHERE recipient_id = ' . $user->id . ' AND is_read = 0'));
        return $unread_messages[0]->total;
    }

    public static function getMessageRecipientDetail($user_id, $message_id)
    {
        $message_detail = MessageRecipient::where('recipient_id', $user_id)->where('message_id',  $message_id)->first();
        if (count($message_detail) == 1) {
            return MessageRecipient::where('recipient_id', $user_id)->where('message_id',  $message_id)->first();
        }
        return null;
    }

    public static function unapprovedOffices()
    {
        return Office::where('is_approved', '<>', 1)->where('is_banned', 0)->get();
    }

    public static function unapprovedProjects()
    {
        return Project::where('approval_status', 0)->get();
    }

    public static function getRating($user_id, $question_id)
    {
        $find_rating = QuestionnaireAnswer::where('user_id', '=', $user_id)->where('question_id', '=', $question_id)->first();
        if (count($find_rating) > 0) {
            return $find_rating->rating;
        }
        return 0;
    }
    public static function getDescriptionAnswer($user_id, $question_id)
    {
        $find_description = QuestionnaireAnswer::where('user_id', '=', $user_id)->where('question_id', '=', $question_id)->first();
        if (count($find_description) > 0) {
            return $find_description->description;
        }
        return '';
    }

}