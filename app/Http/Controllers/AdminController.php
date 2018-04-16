<?php

namespace App\Http\Controllers;

use App\Libraries\Helpers;
use App\Office;
use App\Project;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
        Helpers::setCurrentPage('dashboard');
    }

    public function index()
    {
        $projects = Project::all();
        $offices = Office::all();

        $offices_count = $offices->count();
        $approved_offices_count = $offices->where('is_approved', 1)->where('is_banned', 0)->count();
        $unapproved_offices_count = $offices->where('is_approved', '<>', 1)->where('is_banned', 0)->count();
        $banned_offices_count = $offices->where('is_banned', 1)->count();


        $projects_count = $projects->count();
        $approved_projects_count = $projects->whereIn('approval_status', [1, 3])->count();
        $unapproved_projects_count = $projects->where('approval_status', 0)->count();
        $banned_projects_count = $projects->whereIn('approval_status', [2, 4, 5, 6])->count();

//
//        $total_projects = $projects->count();
//
//        $approved_offices = $offices->where('is_approved', 1)->where('is_banned', 0);
//        $unapproved_offices = $offices->where('is_approved', '<>', 1)->where('is_banned', 0);
//        $banned_offices = $offices->where('is_banned', 1);
//
//        //approval status => 0 = waiting approval, 1. partially approved, 2. denied, 3. fully approved, 4. denied sufficiently with prior donations (denied but approved on previous projects, 5. pended (with pending_reason), 6. requested (with requested_detail)
//        $approved_projects = $projects->whereIn('approval_status', [1, 3])->sortByDesc('id')->forPage(1, 10);
//        $unapproved_projects = $projects->where('approval_status', 0)->sortByDesc('id')->forPage(1, 10);
//        $banned_projects = $projects->whereIn('approval_status', [2, 4, 5, 6])->sortByDesc('id')->forPage(1, 10);
        return view('admin.admin_dashboard',
            compact(
                'offices_count',
                'approved_offices_count',
                'unapproved_offices_count',
                'banned_offices_count',
                'projects_count',
                'approved_projects_count',
                'unapproved_projects_count',
                'banned_projects_count'
            ));
    }
}
