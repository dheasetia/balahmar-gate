<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Receipt;
use App\Project;
use App\Libraries\Helpers;

class AdminReceiptController extends Controller
{
    public function __construct()
    {
        Helpers::setCurrentPage('admin-projects-index');
    }

    public function show($id)
    {
        $receipt = Receipt::findOrFail($id);
        $project = Project::findOrFail($receipt->project_id);

        return view('admin.receipts.admin_receipt_show', compact('receipt', 'project'));
    }
}
