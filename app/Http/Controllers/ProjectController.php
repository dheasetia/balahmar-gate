<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectUpdateRequest;
use App\Http\Requests\ReceiptPostRequest;
use App\Libraries\Helpers;
use App\Project;
use App\Kind;
use App\City;
use App\Receipt;
use App\Report;
use Illuminate\Http\Request;
use App\Http\Requests\ProjectPostRequest;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class ProjectController extends Controller
{
    public function __construct()
    {
        Helpers::setCurrentPage('projects');
        $this->middleware('must_have_office');
        $this->middleware('office_approved');
        $this->middleware('not_banned');

    }

    public function index()
    {
        $projects = Sentinel::getUser()->projects;
        $seq_num = 0;
        return view('projects.project_index', compact('projects', 'seq_num'));
    }

    public function create()
    {
        if (Sentinel::getUser()->office->is_approved == 0) {
            return redirect(url('office'));
        }

        $kinds = Kind::all('id', 'name');
        $cities = City::all('id', 'name');
        return view('projects.project_create', compact('kinds', 'cities'));
    }

    public function store(ProjectPostRequest $request)
    {

        $array_hijri = explode('/ ', $request->input('hijri_created'));

        $array_execution_hijri = explode('/ ', $request->input('execution_date'));

        $project = new Project();
        $project->name = $request->name;
        $project->description = $request->description;
        $project->hijri_created_day = $array_hijri[0];
        $project->hijri_created_month = $array_hijri[1];
        $project->hijri_created_year = $array_hijri[2];

        $project->responsible_person = $request->responsible_person;
        $project->donation_requested = $request->donation_requested;
        $project->mobile = $request->mobile;
        $project->email = $request->email;
        $project->office_id = Sentinel::getUser()->office->id;
        $project->user_id = Sentinel::getUser()->id;
        $project->kind_id = $request->kind_id;
        $project->city_id = $request->city_id;
        $project->hijri_execution_day = $array_execution_hijri[0];
        $project->hijri_execution_month = $array_execution_hijri[1];
        $project->hijri_execution_year = $array_execution_hijri[2];
        $project->execution_date = $request->greg_execution_date;

        if ($request->hasFile('document_path')) {
            $now = time() . '_';
            $document = $request->file('document_path');
            $destination = public_path('files_projects/');
            $file_name = $now . $document->getClientOriginalName();
            if ($document->move($destination, $file_name)) {
                $project->document_path = $file_name;
            }
        }

        $project->save();
        flash('تقديم مشروع جديد', 'تم حفظ بيانات المشروع', 'success');
        return redirect('/projects');
    }

    public function show($id)
    {
        $project = Project::findOrFail($id);
        if ($project->user_id != Sentinel::getUser()->id) {
            return abort(404);
        }
        $reports = Report::where('project_id', '=', $project->id)->get();
        $kinds = Kind::all('id', 'name');
        $cities = City::all('id', 'name');
        $receipts = Receipt::where('project_id', $project->id)->get();
        $report_seq_num = 0;
        $receipt_seq_num = 0;
        return view('projects.project_show', compact('project','kinds', 'cities', 'reports', 'receipt_seq_num', 'report_seq_num', 'receipts'));
    }



    public function edit($id)
    {
        $project = Project::findOrFail($id);
        $kinds = Kind::all('id', 'name');
        $cities = City::all('id', 'name');
        return view('projects.project_edit', compact('project', 'kinds', 'cities'));
    }

    public function update(ProjectUpdateRequest $request, $id)
    {
        $project = Project::findOrFail($id);
        $array_hijri = explode('/ ', $request->input('hijri_created'));

        $array_execution_hijri = explode('/ ', $request->input('execution_date'));

        $project->name = $request->name;
        $project->description = $request->description;
        $project->donation_requested = $request->donation_requested;
        $project->hijri_created_day = $array_hijri[0];
        $project->hijri_created_month = $array_hijri[1];
        $project->hijri_created_year = $array_hijri[2];

        $project->responsible_person = $request->responsible_person;
        $project->mobile = $request->mobile;
        $project->email = $request->email;
        $project->office_id = Sentinel::getUser()->office->id;
        $project->user_id = Sentinel::getUser()->id;
        $project->kind_id = $request->kind_id;
        $project->city_id = $request->city_id;
        $project->video_link = $request->video_link;
        $project->hijri_execution_day = $array_execution_hijri[0];
        $project->hijri_execution_month = $array_execution_hijri[1];
        $project->hijri_execution_year = $array_execution_hijri[2];

        if ($request->hasFile('document_path')) {
            $now = time() . '_';
            $document = $request->file('document_path');
            $destination = public_path('files_projects/');
            $file_name = $now . $document->getClientOriginalName();
            if ($document->move($destination, $file_name)) {
                $project->document_path = $file_name;
            }
        }

        $project->save();
        flash('تعديل بيانات المشروع', 'تم تعديل بيانات المشروع', 'success');
        return redirect(url('/projects', $project->id));
    }

    public function reports_create($id)
    {
        $project = Project::findOrFail($id);
        return view('projects.project_reports_create', compact('project'));
    }

    public function reports_index(Request $request)
    {
        $project = Project::where('id', '=', $request->id)->where('user_id', '=', Sentinel::getUser()->id)->first();
        if (count($project) < 1) {
            return abort(404);
        }
        $reports = Report::where('project_id', $request->id)->get();
        $seq_num = 0;
        return view('projects.project_report_index', compact('reports', 'seq_num'));
    }

    public function receipt_create($id)
    {
        $project = Project::findOrFail($id);
        if ($project->user_id != Sentinel::getUser()->id) {
            return abort(404);
        }
        return view('projects.project_receipts_create', compact('project'));
    }

    public function receipt_store(ReceiptPostRequest $request)
    {

        $now = time() . '_';

        $hijri_received = explode('/ ', $request->hijri_received);
        $hijri_received_day = $hijri_received[0];
        $hijri_received_month = $hijri_received[1];
        $hijri_received_year = $hijri_received[2];

        $date_received = explode('/ ', $request->date_received);
        $date_received_day = $date_received[0];
        $date_received_month = $date_received[1];
        $date_received_year = $date_received[2];

        $receipt = new Receipt();
        $receipt->project_id = $request->project_id;
        $receipt->received_date = $date_received_year . '-' . $date_received_month . '-' . $date_received_day;
        $receipt->receiver_name = $request->receiver_name;
        $receipt->amount = $request->amount;
        $receipt->hijri_received_day = $hijri_received_day;
        $receipt->hijri_received_month = $hijri_received_month;
        $receipt->hijri_received_year = $hijri_received_year;
        $receipt->description = $request->description;
        $receipt->user_id = Sentinel::getUser()->id;


        if($request->hasFile('document_path')){
            $document = $request->file('document_path');
            $destination_path = public_path('files_receipts');

            $file_name = $now . $document->getClientOriginalName();
            if($document->move($destination_path, $file_name)){
                $receipt->document_path = $file_name;
            }

        }

        $receipt->save();
        flash('رفع ملف سند استلام', 'تم حفظ سند استلام', 'success');
        return redirect(url('projects', $receipt->project_id));
    }
}
