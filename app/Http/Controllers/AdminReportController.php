<?php

namespace App\Http\Controllers;

use App\Libraries\Helpers;
use App\Report;
use Illuminate\Http\Request;

class AdminReportController extends Controller
{
    public function __construct()
    {
        Helpers::setCurrentPage('reports');
    }
    public function index()
    {
        $reports = Report::all();
        $seq_num  = 0;
        return view('admin.reports.admin_report_index', compact('reports', 'seq_num'));
    }

    public function show($id)
    {
        $report = Report::findOrFail($id);
        return view('admin.reports.admin_report_show',compact('report'));
    }
}
