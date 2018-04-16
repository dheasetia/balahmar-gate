<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadPictureRequest;
use App\Libraries\Helpers;
use App\Project;
use App\Report;
use App\ReportPicture;
use Carbon\Carbon;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use App\Http\Requests\ReportPostRequest;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function __construct()
    {
        Helpers::setCurrentPage('proposals');
        $this->middleware('must_have_office');
        $this->middleware('office_approved');
        $this->middleware('not_banned');
    }

    public function index()
    {
        $reports = Sentinel::getUser()->reports;
        $seq_num = 0;
        return view('reports.report_index', compact('reports', 'seq_num'));
    }

    public function create()
    {
        $projects = DB::table('projects')
                        ->where('user_id', '=', Sentinel::getUser()->id)
                        ->where(function($query) {
                            $query->where('approval_status', '=', 1)
                                ->orWhere('approval_status', '=', 3);
                        })->get();
        return view('reports.report_create', compact('projects'));
    }

    public function store(ReportPostRequest $request)
    {
        $report = new Report();
        $project = Project::findOrFail($request->project_id);

        $hijri_created_array = explode('/ ', $request->hijri_created);
        $hijri_report_from_array = explode('/ ', $request->hijri_report_from);
        $report_from_array = explode('/ ', $request->report_from);
        $hijri_report_to_array = explode('/ ', $request->hijri_report_to);
        $report_to_array = explode('/ ', $request->report_to);

        $report->hijri_created_day = $hijri_created_array[0];
        $report->hijri_created_month = $hijri_created_array[1];
        $report->hijri_created_year = $hijri_created_array[2];

        $report->name = $project->name;
        $report->nth = $request->nth;
        $report->project_id = $request->project_id;

        $report->user_id = Sentinel::getUser()->id;
        $report->office_id = Sentinel::getUser()->office->id;

        $report->report_from = $report_from_array[2] . '-' . $report_from_array[1] . '-' . $report_from_array[0];
        $report->hijri_report_from_day = $hijri_report_from_array[0];
        $report->hijri_report_from_month = $hijri_report_from_array[1];
        $report->hijri_report_from_year = $hijri_report_from_array[2];

        $report->report_to = $report_to_array[2] . '-'  . $report_to_array[1] . '-' . $report_to_array[0];
        $report->hijri_report_to_day = $hijri_report_to_array[0];
        $report->hijri_report_to_month = $hijri_report_to_array[1];
        $report->hijri_report_to_year = $hijri_report_to_array[2];

        $report->video_link = $request->video_link;
        $report->save();

        if ($request->hasFile('document_path')) {
            $now = time() . '_';
            $document = $request->file('document_path');
            $destination = public_path('files_reports/');
            $file_name = $now . $document->getClientOriginalName();
            if ($document->move($destination, $file_name)) {
                $report->document_path = $file_name;
                $report->save();
            }
        }


        flash('رفع التقرير', 'تم حفظ التقرير', 'success');
        return redirect(url('/reports', $report->id));

    }

    public function edit($id)
    {
        $report = Report::findOrFail($id);
        $projects = Project::all();
        return view('reports.report_edit', compact('report', 'projects'));
    }

    public function update(ReportPostRequest $request, $id)
    {
        $report = Report::findOrFail($id);

        $project = Project::findOrFail($request->project_id);

        $hijri_created_array = explode('/ ', $request->hijri_created);
        $hijri_report_from_array = explode('/ ', $request->hijri_report_from);
        $report_from_array = explode('/ ', $request->report_from);
        $hijri_report_to_array = explode('/ ', $request->hijri_report_to);
        $report_to_array = explode('/ ', $request->report_to);

        $report->hijri_created_day = $hijri_created_array[0];
        $report->hijri_created_month = $hijri_created_array[1];
        $report->hijri_created_year = $hijri_created_array[2];

        $report->name = $project->name;
        $report->nth = $request->nth;
        $report->project_id = $request->project_id;

        $report->report_from = $report_from_array[2] . '-' . $report_from_array[1] . '-' . $report_from_array[0];
        $report->hijri_report_from_day = $hijri_report_from_array[0];
        $report->hijri_report_from_month = $hijri_report_from_array[1];
        $report->hijri_report_from_year = $hijri_report_from_array[2];

        $report->report_to = $report_to_array[2] . '-'  . $report_to_array[1] . '-' . $report_to_array[0];
        $report->hijri_report_to_day = $hijri_report_to_array[0];
        $report->hijri_report_to_month = $hijri_report_to_array[1];
        $report->hijri_report_to_year = $hijri_report_to_array[2];

        $report->video_link = $request->video_link;
        $report->save();

        if ($request->hasFile('document_path')) {
            $now = time() . '_';
            $document = $request->file('document_path');
            $destination = public_path('files_reports/');
            $file_name = $now . $document->getClientOriginalName();
            if ($document->move($destination, $file_name)) {
                $report->document_path = $file_name;
                $report->save();
            }
        }


        flash('تعديل التقرير', 'تم حفظ بيانات التقرير', 'success');
        return redirect(url('/reports', $report->id));
    }

    public function show($id)
    {
        $report = Report::findOrFail($id);
        return view('reports.report_show', compact('report'));
    }

    public function store_picture(UploadPictureRequest $request)
    {
        $picture = new ReportPicture();

    }
}
