<?php

namespace App\Http\Controllers;

use App\Office;
use App\Project;
use App\QuestionnaireAnswer;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('cors');
    }

    public function fetch_office($iban) {
        $office = Office::where('iban', $iban)->first();
        if (count($office) > 0) {
            return response()->json($office);
        }
        return response('Office not found', 404);
    }

    public function fetch_project($id) {
        $project = Project::find($id);
        if (count($project) > 0) {
            return response()->json($project);
        }
        return response('Office not found', 404);
    }

    public function set_balahmar_office_id(Request $request, $iban)
    {
        $office = Office::where('iban', $iban)->first();
        if (count($office) > 0) {
            $balahmar_id = $request->balahmarid;
            if ($request->token == '$2y$10$oFAU9bomcwwiV9YBcT.NEuJeDcKmfmIY.PXgkgf5dhbw.qa/RhO1K') {
                $office->id_at_balahmar = $balahmar_id;
                $office->save();
                return response('saved', 200);
            } else {
                response('Wrong token', 501);
            }
        } else {
            return response('Office not found', 404);
        }
        return response('fail', 501);
    }

    public function set_balahmar_project_id(Request $request, $id)
    {
        $project = Project::find(id);
        if (count($project) > 0) {
            $balahmar_id = $request->balahmar_id;
            if ($request->token == bcrypt('dheasetia')) {
                $project->id_at_balahmar = $balahmar_id;
                $project->save();
                return response('saved', 200);
            }
        }
        return response('fail', 404);
    }

    // AJAX
    //approval status => 0 = waiting approval, 1. partially approved, 2. denied, 3. fully approved, 4. denied sufficiently with prior donations (denied but approved on previous projects, 5. pended (with pending_reason), 6. requested (with requested_detail)
    public function load_approved_projects(Request $request)
    {

        if ($request->start == '') {
            $start = 1;
        } else {
            $start = $request->start;
        }

        $projects = DB::table('projects')
            ->join('offices', 'projects.office_id', '=', 'offices.id')
            ->select('projects.id',
                'projects.name AS project_name',
                'projects.hijri_created_day',
                'projects.hijri_created_month',
                'projects.hijri_created_year',
                'projects.approval_status',
                'projects.hijri_approval_day',
                'projects.hijri_approval_month',
                'projects.hijri_approval_year',
                'projects.hijri_execution_day',
                'projects.hijri_execution_month',
                'projects.hijri_execution_year',
                'offices.id AS office_id',
                'offices.name AS office_name',
                'offices.logo')
            ->where('approval_status', '=', 1)
            ->orWhere('approval_status', '=', 3)
            ->orderBy('projects.id', 'desc')
            ->get()->forPage($start, 10);
        $result = array();
        $seq = (($start -1) * 10) + 1;
        foreach ($projects as $approved_project) {
            $line  = '<div class="item">';
            $line .= '<div class="item-head">';
            $line .= '<div class="item-details">';
            $line .= '<img class="item-pic rounded" src="'. asset('files_logos/' . ($approved_project->logo == '' ? 'logo-blank.png' : $approved_project->logo)).'">';
            $line .= '<a href="'. url('admin/projects', $approved_project->id) .'" class="item-name primary-link">'. $approved_project->project_name.'</a>';
            $line .= '<span class="item-label">' . $approved_project->hijri_created_day . '/ ' . $approved_project->hijri_created_month . '/ ' . $approved_project->hijri_created_year . ' هـ </span>';
            $line .= '</div>';
            $line .= '<span class="item-status">تاريخ الاعتماد: ' . $approved_project->hijri_approval_day . '/ ' . $approved_project->hijri_approval_month . '/ ' . $approved_project->hijri_approval_year . ' هـ </span>';
            $line .= '</div>';
            $line .= '<div class="item-body"><a href="'. url('admin/offices', $approved_project->office_id) .'">'. $approved_project->office_name.'</a></div>';
            $line .= '</div>';
            array_push($result, $line);
        }
        return response()->json($result);
    }

    public function load_waiting_projects(Request $request)
    {
        if ($request->start == '') {
            $start = 1;
        } else {
            $start = $request->start;
        }
        $projects = Project::where('approval_status', '0')->orWhere('approval_status', '5')->orWhere('approval_status', '6')->get()->sortByDesc('id')->forPage($start, 10);
        $result = array();
        $seq = 1;
            foreach ($projects as $approved_project) {
                $line = '<tr>';
                $line .= '<td>' . $seq++ . '</td><td><a href="' . url('admin/projects', $approved_project->id) . '" class="tooltips" data-original-title="تفاصيل المشروع">' . $approved_project->name . '</a></td>';
                $line .= '<td>' . $approved_project->office->name . '</td>';
                $line .= '<td>' . $approved_project->hijri_created_day . '/ ' . $approved_project->hijri_created_month . '/ ' . $approved_project->hijri_created_year . '</td>';
                    if($approved_project->approval_status == 1) {
                        $line .= '<td>' . $approved_project->hijri_approval_day . '/ ' . $approved_project->hijri_approval_month . '/ ' . $approved_project->hijri_approval_year . '</td>';
                    } else {
                        $line .= '<td>---</td>';
                    }
                $line .= '<td>' . $approved_project->kind->name . '</td>';
                $line .= '<td>{{$approved_project->hijri_execution_day . '/ ' . $approved_project->hijri_execution_month . '/ ' . $approved_project->hijri_execution_year}} هـ</td>';
                $line .= '</tr>';
                array_push($result, $line);
            }
        return response()->json($result);
    }

    public function load_denied_projects(Request $request)
    {
        if ($request->start == '') {
            $start = 1;
        } else {
            $start = $request->start;
        }
        $projects = Project::where('approval_status', '2')->orWhere('approval_status', '4')->get()->sortByDesc('id')->forPage($start, 10);
        return response()->json($projects);
    }

    public function office_count_by_city()
    {
        $result = DB::table('offices')
            ->join('cities', 'offices.city_id', '=', 'cities.id')
            ->select(DB::raw('cities.name as city, count(offices.city_id) as count'))
            ->groupBy('offices.city_id')
            ->get();
        return response()->json($result);
    }

    public function donation_by_month_this_year()
    {
        $temp = DB::select('select month(approval_date) as month, year(approval_date) as year, sum(donation_approved) as total from projects where donation_approved > 0 group by year(approval_date), month(approval_date)');
        $result = array();
        foreach ($temp as $tem) {
            $month_date = ['category' => $this->getArabicMonth($tem->month) . ' ' . $tem->year, 'total' => $tem->total];
            array_push($result, $month_date);
        }
        return response()->json($result);
    }

    private function getArabicMonth($number)
    {
        switch ($number) {
            case '1':
                return 'يناير';
                break;
            case '2':
                return 'فبراير';
                break;
            case '3':
                return 'مارس';
                break;
            case '4':
                return 'أبريل';
                break;
            case '5':
                return 'مايو';
                break;
            case '6':
                return 'يونيو';
                break;
            case '7':
                return 'يوليو';
                break;
            case '8':
                return 'أغسطس';
                break;
            case '9':
                return 'سبتمبر';
                break;
            case '10':
                return 'أكتوبر';
                break;
            case '11':
                return 'نوفمبر';
                break;
            case '12':
                return 'ديسمبر';
                break;

        }
    }

    public function answer_questionnaire(Request $request)
    {
        $question_id = $request->question_id;
        $user_id = Sentinel::getUser()->id;

        $old_answer = QuestionnaireAnswer::where('question_id', '=', $question_id)->where('user_id', '=', $user_id)->first();
        if (count($old_answer) > 0) {
            $answer = $old_answer;
        } else {
            $answer = new QuestionnaireAnswer();
        }
        $answer->user_id = $user_id;
        $answer->question_id = $question_id;
        $answer->rating = $request->rating;
        $answer->save();
        return response()->json($answer->rating);
    }

    public function answer_questionnaire_description(Request $request)
    {
        $question_id = $request->question_id;
        $user_id = Sentinel::getUser()->id;

        $old_answer = QuestionnaireAnswer::where('question_id', '=', $question_id)->where('user_id', '=', $user_id)->first();
        if (count($old_answer) > 0) {
            $answer = $old_answer;
        } else {
            $answer = new QuestionnaireAnswer();
        }
        $answer->user_id = $user_id;
        $answer->question_id = $question_id;
        $answer->description = $request->description;
        $answer->save();
        return response()->json($answer->description);
    }

    public function get_unapproved_office_count()
    {
        if (Sentinel::getUser()->inRole('admin')) {
            $unapproved_office =  Office::where('is_approved', '<>', 1)->where('is_banned', 0)->get();
            return response()->json(['unapproved_offices_count' => $unapproved_office->count()]);
        }
        return response('Not Authorized', 403);
    }
}
