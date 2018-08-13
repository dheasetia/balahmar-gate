<?php

namespace App\Http\Controllers;

use App\Libraries\Helpers;
use App\Message;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use App\Http\Requests\MessagePostRequest;
use App\MessageRecipient;
use Brian2694\Toastr\Facades\Toastr;
use Cartalyst\Sentinel\Users\EloquentUser;
use App\Group;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function __construct()
    {
        Helpers::setCurrentPage('messages');
        $this->middleware('must_have_office');
        $this->middleware('office_approved');
        $this->middleware('not_banned');
    }

    public function index(){
        $inbox = Sentinel::getUser()->messages->sortByDesc('id');
        $outbox = Message::where('creator_id', Sentinel::getUser()->id)->where('is_draft', 0)->get()->sortByDesc('id');
        $drafts = Message::where('is_draft', 1)->get()->sortByDesc('id');
        return view('messages.message_index', compact('inbox', 'outbox', 'drafts'));
    }

    public function show($id)
    {
        $message = Message::findOrFail($id);
        $message_id = $id;
        $messages = array();

        if (($message->creator_id == Sentinel::getUser()->id) or (count(Helpers::getMessageRecipientDetail(Sentinel::getUser()->id, $message->id)) == 1)) {
            if ($message->parent_id == null) {
                $parent_id = $message->id;
                $messages[0] = $message;
                $children = Message::where('parent_id', $parent_id)->get();
                foreach ($children as $child) {
                    array_push($messages, $child);
                }
            } else {
                $parent_id = $message->parent_id;
                $first_message = Message::find($parent_id);
                $messages[0] = $first_message;
                $messages_temp = Message::where('parent_id', $parent_id)->orderBy('created_at')->get();
                foreach ($messages_temp as $item) {
                    array_push($messages, $item);
                }
            }

            $message_recipients = MessageRecipient::where('recipient_id', Sentinel::getUser()->id)->get();
            if (count($message_recipients) > 0) {
                foreach ($message_recipients as $item) {
                    $message_recipient = MessageRecipient::find($item->id);
                    $message_recipient->is_read = 1;
                    $message_recipient->save();
                }
            }

            return view('messages.message_show', compact('messages', 'message_id'));
        }
        return abort(404, 'لا توجد رسالة');
    }

    public function create()
    {
        return view('messages.message_create');
    }

    public function store(MessagePostRequest $request)
    {
        $array_hijri = explode('/ ', $request->input('hijri_created'));
        $message = new Message();
        $message->creator_id = Sentinel::getUser()->id;
        $message->hijri_created_day = $array_hijri[0];
        $message->hijri_created_month = $array_hijri[1];
        $message->hijri_created_year = $array_hijri[2];
        $message->subject = $request->subject;
        if ($request->parent_id != '') {
            $message->parent_id = $request->parent_id;
        }
        $message->body  = $request->body;

        if ($request->hasFile('attachment')) {
            $now = time() . '_';
            $document = $request->file('attachment');
            $destination = public_path('files_messages/');
            $file_name = $now . $document->getClientOriginalName();
            if($document->move($destination, $file_name)) {
                $message->attachment = $file_name;
            }
        }
        $message->save();

        if (count($request->recipients) > 0) {
            foreach ($request->recipients as $recipient) {
                if ($recipient != '') {
                    $message_recipient = new MessageRecipient();
                    $message_recipient->recipient_id = $recipient;
                    $message_recipient->message_id = $message->id;
                    $message_recipient->save();
                }
            }

        }
        Toastr::success('تم إرسال الرسائل', 'الرسائل الداخلية');
        return redirect(url('messages', $message->id));


    }
}
