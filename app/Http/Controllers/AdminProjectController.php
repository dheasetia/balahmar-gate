<?php

namespace App\Http\Controllers;

use App\Libraries\Helpers;
use App\Libraries\Track;
use App\Mail\ProjectApprovedMail;
use App\Mail\ProjectDeniedMail;
use App\Mail\ProjectFullyApprovedEmail;
use App\Mail\ProjectPendedEmail;
use App\Mail\ProjectRequestedEmail;
use App\Mail\ProjectSufficientEmail;
use App\Project;
use App\ProjectApproval;
use App\Receipt;
use App\Report;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class AdminProjectController extends Controller
{
    public function __construct()
    {
        Helpers::setCurrentPage('admin-projects-index');
    }
    public function index()
    {
        $projects = Project::all();
        $seq_num = 0;
        return view('admin.projects.admin_project_index', compact('projects', 'seq_num'));
    }

    public function show($id)
    {
        $project = Project::findOrFail($id);
        $office = $project->office;
        $reports = Report::where('project_id', '=', $project->id)->get();
        $receipts = Receipt::where('project_id', $project->id)->get();
        $report_seq_num = 0;
        $receipt_seq_num = 0;
        $other_projects = DB::table('projects')->where('office_id', $office->id)->where('approval_status', 1 or 3)->where('id', '<>', $project->id)->get();
        return view('admin.projects.admin_project_show', compact('project', 'other_projects', 'reports', 'receipts', 'report_seq_num', 'receipt_seq_num'));
    }

    public function approve(Request $request)
    {
        //approval status => 0 = waiting approval, 1. partially approved, 2. denied, 3. fully approved, 4. denied sufficiently with prior donations (denied but approved on previous projects, 5. pended (with pending_reason), 6. requested (with requested_detail)
        $array_hijri = explode('/ ', $request->input('hijri_approval'));
        $user = Sentinel::getUser();
        $project = Project::findOrFail($request->project_id);
        $project->approval_status = $request->approval_status;
        $abul_bara = User::find(2);
        $abah = User::find(1);
        /**
         * PLEASE TO BE CONSIDERED IN ALL APPROVAL AND ALL DENYING
         * approval_status
         * donation_approved
         * approval_date
         * approval_hijri_date
         * donation_purpose
         * pending_reason
         * other_project_donated_id
         * ban_reason
         *
         */
        if($request->approval_status == 2) {  //PROJECT DENIED
            //make sure:
            $project->donation_approved = 0;
            $project->approval_date = null;
            $project->hijri_approval_day = null;
            $project->hijri_approval_month = null;
            $project->hijri_approval_year = null;
            $project->donation_purpose = null;
            $project->pending_reason = null;
            $project->requested_detail = null;
            $project->other_project_donated_id = null;
            $project->ban_reason = $request->ban_reason; //<<---


            Mail::to($project->user)
                ->bcc([$abul_bara, $abah])
                ->send(new ProjectDeniedMail($project));
            Track::insert('الاعتذار عن الموافقة على مشروع: ' . $project->name . '،مع إرسال الإيميل', 'deny_project');
            Toastr::success('تم الاعتذار عن موافقة المشروع: ' . $project->name, 'الاعتذار عن موافقة المشروع');

        } else if($project->approval_status == 1) { //PARTIALLY APPROVED

            $project->donation_approved = $request->donation_approved;
            $project->donation_purpose = $request->donation_purpose;
            $project->approval_date = date('Y-m-d H:i:s');
            $project->hijri_approval_day = $array_hijri[0];
            $project->hijri_approval_month = $array_hijri[1];
            $project->hijri_approval_year = $array_hijri[2];

            $project->donation_purpose = null;
            $project->pending_reason = null;
            $project->requested_detail = null;
            $project->other_project_donated_id = null;
            $project->ban_reason = null;

            Mail::to($project->user)
                ->bcc([$abul_bara, $abah])
                ->send(new ProjectApprovedMail($project));
            Track::insert('الموافقة بالمساهمة على مشروع: ' . $project->name . ' بمبلغ: ' . $request->donation_approved . '،مع إرسال الإيميل', 'approve_project_partially');
            Toastr::success('تم الموافقة على المشروع: ' . $project->name, 'موافقة المشروع');
        } else if($project->approval_status == 3) { //FULLY APPROVED
            $project->donation_approved = $project->donation_requested;

            $project->approval_date = date('Y-m-d H:i:s');
            $project->hijri_approval_day = $array_hijri[0];
            $project->hijri_approval_month = $array_hijri[1];
            $project->hijri_approval_year = $array_hijri[2];

            $project->donation_purpose = null;
            $project->pending_reason = null;
            $project->requested_detail = null;
            $project->other_project_donated_id = null;
            $project->ban_reason = null;

            Mail::to($project->user)
                ->bcc([$abul_bara, $abah])
                ->send(new ProjectFullyApprovedEmail($project));
            Track::insert('الموافقة الكاملة على المشروع: ' . $project->name . ' مع إرسال الإيميل', 'approve_project_fully');
            Toastr::success('تم الموافقة الكاملة على المشروع: ' . $project->name, 'موافقة المشروع');
        } else if($project->approval_status == 4) { // الاكتفاء بالمشروع السابق
            $project->donation_approved = 0;
            $project->approval_date = date('Y-m-d H:i:s');
            $project->hijri_approval_day = $array_hijri[0];
            $project->hijri_approval_month = $array_hijri[1];
            $project->hijri_approval_year = $array_hijri[2];

            $project->donation_purpose = null;
            $project->pending_reason = null;
            $project->requested_detail = null;
            $project->ban_reason = null;

            $project->other_project_donated_id = $request->other_project_donated_id;
            Mail::to($project->user)
                ->bcc([$abul_bara, $abah])
                ->send(new ProjectSufficientEmail($project));
            Track::insert('الاكتفاء بالمشاريع السابقة: ' . $project->other_project_donated_id . ' بدلا من مشروع:' .  $project->name . ' مع إرسال الإيميل', 'denied_project_sufficient');
            Toastr::success('تم حفظ عملية الاكتفاء عن الدعم على المشروع: ' . $project->name, 'الاكتفاء عن دعم مشروع');
        } else if($project->approval_status == 5) { // pended
            $project->donation_approved = 0;
            $project->approval_date = null;
            $project->hijri_approval_day = null;
            $project->hijri_approval_month = null;
            $project->hijri_approval_year = null;
            $project->donation_purpose = null;
            $project->pending_reason = $request->pending_reason;
            $project->requested_detail = null;
            $project->other_project_donated_id = null;
            $project->ban_reason = null;

            Mail::to($project->user)
                ->bcc([$abul_bara, $abah])
                ->send(new ProjectPendedEmail($project));
            Track::insert('تأجيل الموافقة على مشروع: ' . $project->name . ' مع إرسال الإيميل', 'pending_project');
            Toastr::success('تم حفظ عملية تأجيل الموافقة على مشروع : ' . $project->name, 'تأجيل الموافقة');
        } else if($project->approval_status == 6) { //requested
            $project->donation_approved = 0;
            $project->approval_date = null;
            $project->hijri_approval_day = null;
            $project->hijri_approval_month = null;
            $project->hijri_approval_year = null;
            $project->donation_purpose = null;
            $project->pending_reason = null;
            $project->requested_detail = $request->requested_detail;
            $project->other_project_donated_id = null;
            $project->ban_reason = null;

            Mail::to($project->user)
                ->bcc([$abul_bara, $abah])
                ->send(new ProjectRequestedEmail($project));
            Track::insert('طلب على مشروع: ' .  $project->name . ' مع إرسال الإيميل', 'requested_project');
            Toastr::success('تم حفظ عملية طلب أمر على المشروع: ' . $project->name, 'طلب على أمر');
        }

        $project->save();

        if($request->approval_status == 1 || $request->approval_status == 3) {
            $approval = new ProjectApproval();
            $approval->project_id = $project->id;
            $approval->user_id = $user->id;
            $approval->save();
        }
        return redirect(url('/admin/projects', $project->id));
    }

    public function report_index($id)
    {
        $reports = Report::where('project_id', $id)->get();
        $project = Project::findOrFail($id);
        $seq_num = 0;
        return view('admin.projects.admin_project_report_index', compact('reports', 'project', 'seq_num'));
    }

    public function getApprovedProjects()
    {
        $approved_projects = Project::where('approval_status', 1)->orWhere('approval_status', 3)->get();
        Helpers::setCurrentPage('admin-projects-approved');
        return view('admin.projects.admin_project_approved_index', compact('approved_projects'));
    }

    public function getUnapprovedProjects()
    {
        $unapproved_projects = Project::where('approval_status', 0)->get();
        Helpers::setCurrentPage('admin-projects-unapproved');
        return view('admin.projects.admin_project_unapproved_index', compact('unapproved_projects'));
    }

    public function getBannedProjects()
    {
        $banned_projects = Project::where('approval_status', 2)->orWhere('approval_status', 4)->get();
        Helpers::setCurrentPage('admin-projects-banned');
        return view('admin.projects.admin_project_banned_index', compact('banned_projects'));
    }

    public function getPostponedProjects()
    {
        $postponed_projects = Project::where('approval_status', 5)->get();
        Helpers::setCurrentPage('admin-projects-postponed');
        return view('admin.projects.admin_project_postponed_index', compact('postponed_projects'));
    }
    public function getRequestedProjects()
    {
        $requested_projects = Project::where('approval_status', 6)->get();
        Helpers::setCurrentPage('admin-projects-requested');
        return view('admin.projects.admin_project_requested_index', compact('requested_projects'));
    }

    public function printUnapprovedProjects()
    {
        $unapproved_projects = Project::where('approval_status', 0)->get();
        return view('admin.projects.admin_project_unapproved_print', compact('unapproved_projects'));

    }
}