<?php

namespace App\Http\Controllers;

use App\Project;
use App\Receipt;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use App\Libraries\Helpers;

class ReceiptController extends Controller
{
    public function __construct()
    {
        Helpers::setCurrentPage('projects');
        $this->middleware('must_have_office');
        $this->middleware('office_approved');
        $this->middleware('not_banned');
    }

    public function show($id)
    {
        $receipt = Receipt::findOrFail($id);
        $project = Project::findOrFail($receipt->project_id);
        if ($project->user_id != Sentinel::getUser()->id) {
            return abort(404);
        }
        return view('receipts.receipt_show', compact('receipt', 'project'));
    }
}
