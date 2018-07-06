<?php

namespace App\Http\Controllers;

use App\Office;
use App\Project;
use App\Receipt;
use Brian2694\Toastr\Facades\Toastr;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('user');
        $this->middleware('active');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Sentinel::getUser();
        $office = Sentinel::getUser()->office;

        if ($user->inRole('admin')) {
            return redirect(url('admin'));
        }
        if (count($user->office) == 0) {
            return redirect(url('office/create'));
        }
        if($user->office->is_approved == 0) {
            Toastr::warning('الرجاء الانتظار حتى تحصل الجهة على الموافقة من مجلس الأمناء.', 'انتطار الموافقة');
            return redirect(url('office'));
        }
        $total_projects = count($user->projects);
        $projects = $user->projects;
        $total_received = 0;
        if (count($projects) > 0) {
            foreach ($projects as $project) {
                $receipts = Receipt::where('project_id', '=', $project->id)->get();
                if (count($receipts) > 0) {
                    foreach ($receipts as $receipt) {
                        $total_received += $receipt->amount;
                    }
                }
            }
        }

        $total_donation = Project::where('office_id', $office->id)->get()->sum('donation_approved');
        $seq_num = 0;
        return view('user.user_dashboard', compact('total_projects', 'projects', 'seq_num', 'office', 'total_donation', 'total_received'));
    }

}