<?php

namespace App\Http\Controllers;

use App\Libraries\Helpers;
use App\Proposal;
use App\ProposalApproval;
use App\Project;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use App\Http\Requests\ProposalMakeProjectRequest;

class AdminProposalController extends Controller
{
    public function index()
    {
        $proposals = Proposal::all();
        $seq_num = 0;
        Helpers::setCurrentPage('proposal');
        return view('admin.proposals.admin_proposal_index', compact('proposals', 'seq_num'));
    }
    
    public function show($id)
    {
    	$proposal = Proposal::findOrFail($id);
    	Helpers::setCurrentPage('proposals');
    	return view('admin.proposals.admin_proposal_show', compact('proposal'));
    }

    public function approve(Request $request)
    {
        $array_hijri = explode('/ ', $request->input('hijri_approval'));
    	$user = Sentinel::getUser();
    	$proposal = Proposal::findOrFail($request->proposal_id);
    	$proposal->is_approved = $request->is_approved;
    	if($request->is_approved == 2) {
    	    $proposal->ban_reason = $request->ban_reason;
        } else if($proposal->is_approved == 1) {
    	    $proposal->approval_date = date('Y-m-d H:i:s');
    	    $proposal->hijri_approval_day = $array_hijri[0];
    	    $proposal->hijri_approval_month = $array_hijri[1];
    	    $proposal->hijri_approval_year = $array_hijri[2];
        } else {
    	    $proposal->ban_reason = '';
        }
    	$proposal->save();

        if($request->is_approved == 1) {
            $approval = new ProposalApproval();
            $approval->proposal_id = $proposal->id;
            $approval->user_id = $user->id;
            $approval->save();
        }
        flash('حالة الطلب', 'تم حفظ حالة الطلب', 'success');
        return redirect(url('/admin/proposal', $proposal->id));
    }

    public function make_project(ProposalMakeProjectRequest $request)
    {
        $proposal = Proposal::findOrFail($request->proposal_id);
        if (count($proposal->project) != 0){
            flash('مشروع جديد', 'تم إنشاء مشروع جديد', 'danger');
            return back();
        }
        $user = Sentinel::getUser();
        $project = new Project();
        $project->name = $proposal->project_name;
        $project->description = $proposal->description;
        $project->office_id = $user->office->id;
        $project->hijri_execution_day = $proposal->hijri_execution_day;
        $project->hijri_execution_month = $proposal->hijri_execution_month;
        $project->hijri_execution_year = $proposal->hijri_execution_year;
        $project->kind_id = $proposal->kind_id;
        $project->responsible_person = $proposal->responsible_person;
        $project->mobile = $proposal->mobile;
        $project->email = $proposal->email;
        $project->proposal_id = $proposal->id;
        $project->user_id = $user->id;
        $project->save();
        flash('مشروع جديد', 'تم إنشاء مشروع جديد', 'success');
        return redirect(url('/admin/proposal', $proposal->id));
    }
}