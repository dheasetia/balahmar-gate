<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfficeUpdateRequest;
use App\Libraries\Helpers;
use App\Libraries\Track;
use App\Mail\OfficeApprovedMail;
use App\Mail\OfficeDeniedMail;
use App\Office;
use App\Project;
use App\Report;
use App\Advisor;
use App\Area;
use App\Bank;
use App\City;
use App\User;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Mail;

class AdminOfficeController extends Controller
{
    public function __construct()
    {
        Helpers::setCurrentPage('admin-offices-index');

    }
    public function index()
    {
        $offices = Office::all();
        $seq_num = 0;
        Helpers::setCurrentPage('admin-offices-index');
        return view('admin.offices.admin_office_index', compact('offices', 'seq_num'));
    }

    public function show($id)
    {
        $office = Office::findOrFail($id);
        return view('admin.offices.admin_office_show', compact('office'));
    }

    public function showMyOffice()
    {
        $office = Sentinel::getUser()->office;
        Helpers::setCurrentPage('');
        return view('admin.offices.admin_my_office_show', compact('office'));
    }

    public function editMyOffice() {
        $current_user = Sentinel::getUser();
        $office = $current_user->office;
        $advisors = Advisor::all(['id', 'name']);
        $banks = Bank::all(['id', 'name']);
        $cities = City::all(['id', 'name']);
        $areas = Area::all(['id', 'name']);
        Helpers::setCurrentPage('');
        return view('admin.offices.admin_my_office_edit', compact('office', 'advisors', 'banks', 'cities', 'areas'));
    }

    public function updateMyOffice(OfficeUpdateRequest $request) {
        $current_user = Sentinel::getUser();
        $office = $current_user->office;
        $office->name = $request->name;
        $office->user_id = Sentinel::getUser()->id;
        $office->description = $request->description;
        $office->advisor_id = $request->advisor_id;
        $office->manager_name = $request->manager_name;
        $office->license_no = $request->license_no;
        $office->license_date = $request->license_date;
        $office->bank_id = $request->bank_id;
        $office->iban = $request->iban;
        $office->representative = $request->representative;
        $office->role = $request->role;
        $office->mobile = $request->mobile;
        $office->phone = $request->phone;
        $office->second_phone = $request->second_phone;
        $office->fax = $request->fax;
        $office->email = $request->email;
        $office->is_banned = 0;
        $office->is_active = 0;
        $office->area_id = $request->area_id;
        $office->city_id = $request->city_id;
        $office->street = $request->street;
        $office->district = $request->district;
        $office->building_no = $request->building_no;
        $office->additional_no = $request->additional_no;
        $office->po_box = $request->po_box;
        $office->zip_code = $request->zip_code;
        $office->coordinate = $request->coordinate;
        $office->po_box = $request->po_box;
        $office->note = $request->note;

        if($request->hasFile('license_file')){
            $now = time() . '_';
            $document = $request->file('license_file');
            $destination_path = public_path('files_licenses');

            $file_name = $now . $document->getClientOriginalName();
            if($document->move($destination_path, $file_name)){
                $office->license_file = $file_name;
            }

        }

        if($request->hasFile('bank_file')){
            $now = time() . '_';
            $document = $request->file('bank_file');
            $destination_path = public_path('files_banks');

            $file_name = $now . $document->getClientOriginalName();
            if($document->move($destination_path, $file_name)){
                $office->bank_file = $file_name;
            }

        }

        if($request->hasFile('logo')){
            $now = time() . '_';
            $document = $request->file('logo');
            $destination_path = public_path('files_logos');

            $file_name = $now . $document->getClientOriginalName();
            if($document->move($destination_path, $file_name)){
                $office->logo = $file_name;
            }

        }
        Track::insert('تحديث بيانات جهتي', 'edit_office', 'حفظ تعديل بيانات جهتي');
        $office->save();
        Toastr::success('تم تعديل بيانات الجهة', 'تعديل بيانات الجهة');
        return redirect('admin/office');
    }

    public function approve(Request $request)
    {
        $abul_bara = User::find(2);
        $abah = User::find(1);
        $office = Office::findOrFail($request->office_id);
        $office->is_approved = 1;
        $office->is_banned = 0;
        $office->ban_reason = '';
        $office->save();
        Mail::to($office->user)
            ->bcc([$abul_bara, $abah])
            ->send(new  OfficeApprovedMail($office));
        Track::insert('الموافقة على الجهة: ' . $office->name, 'approve_office');
        Toastr::success('تم تعميد الجهة: ' . $office->name, 'تعميد الجهة');
        if ($request->previous_page != '') {
            if ($request->previous_page == 'unapproved') {
                return redirect(url('admin/offices/unapproved'));
            }
        }
        return redirect(url('admin/offices', $office->id));
    }

    public function unapprove(Request $request)
    {
        $office = Office::findOrFail($request->office_id);
        $office->is_approved = 0;
        $office->is_banned = 0;
        $office->ban_reason = '';
        $office->save();
        Track::insert('إلغاء الموافقة على الجهة: ' . $office->name, 'unapprove_office');
        Toastr::success('تم إلغاء تعميد الجهة: ' . $office->name, 'تعميد الجهة');
        return redirect(url('admin/offices', $office->id));
    }



    public function projects($id)
    {
        $office = Office::findOrFail($id);
        $projects = $office->projects;
        return view('admin.offices.admin_office_projects', compact('office', 'projects'));
    }


    public function ban(Request $request)
    {
        $abul_bara = User::find(2);
        $abah = User::find(1);
        $office = Office::findOrFail($request->office_id);
        $office->is_banned = 1;
        $office->ban_reason = $request->ban_reason;
        $office->is_approved = 0;
        $office->save();
        Mail::to($office->user)
            ->bcc([$abul_bara, $abah])
            ->send(new OfficeDeniedMail($office));
        Track::insert('اعتذار عن الموفقة على الجهة: ' . $office->name, 'ban_office');
        Toastr::success('تم رفض الجهة مع إرسال البريد الألكتروني', 'رفض الجهة');
        return redirect(url('admin/offices', $office->id));
    }

    public function getApprovedOffices()
    {
        $approved_offices = Office::where('is_approved', '1')->where('is_banned', 0)->get();
        Helpers::setCurrentPage('admin-offices-approved');
        return view('admin.offices.admin_approved_office_index', compact('approved_offices'));
    }

    public function getUnapprovedOffices()
    {
        $unapproved_offices = Office::where('is_approved', '<>', 1)->where('is_banned', 0)->get();
        Helpers::setCurrentPage('admin-offices-unapproved');
        return view('admin.offices.admin_unapproved_office_index', compact('unapproved_offices'));
    }

    public function getBannedOffices()
    {
        $banned_offices = Office::where('is_banned', 1)->get();
        Helpers::setCurrentPage('admin-offices-banned');
        return view('admin.offices.admin_banned_office_index', compact('banned_offices'));
    }

    public function destroy(Request $request, $id)
    {
        $office = Office::findOrFail($id);

        $projects = Project::where('office_id', $office->id)->get();
        if (count($projects) > 0) {
            foreach ($projects as $project) {
                $project->delete();
            }
        }
        $reports = Report::where('office_id', $office->id)->get();
        if (count($reports) > 0) {
            foreach ($reports as $report) {
                $report->delete();
            }
        }

        Track::insert('حفذف الجهة: ' . $office->name, 'delete_office');
        $office->delete();
        Toastr::success('تم حذف الجهة: ' . $office->name , 'حذف الجهة');
        if ($request->previous_page != '') {
            if ($request->previous_page == 'unapproved_offices') {
                return redirect(url('admin/offices/unapproved'));
            }
        }
        return redirect(url('admin/offices'));
    }

    public function getSuspendedOffices()
    {
        $suspended_offices = Office::where('is_suspended', '=', 1)->get();
        Helpers::setCurrentPage('admin-offices-suspended');
        return view('admin.offices.admin_suspended_office_index', compact('suspended_offices'));
    }

    public function suspend(Request $request)
    {
        $office = Office::findOrFail($request->office_id);
        if ($office == null) {
            Toastr::error('تعذرت عملية إيقاف المشاريع للجهة ', 'إيقاف مشاريع الجهة');
            return redirect(url('admin/offices', $office->id));
        }
        $office->is_suspended = 1;
        $office->save();
        Toastr::success('تم إيقاف المشاريع للجهة ', 'إيقاف مشاريع الجهة');
        return redirect(url('admin/offices', $office->id));
    }

    public function unsuspend(Request $request)
    {
        $office = Office::findOrFail($request->office_id);
        if ($office == null) {
            Toastr::error('تعذرت عملية إيقاف المشاريع للجهة ', 'إيقاف مشاريع الجهة');
            return redirect(url('admin/offices', $office->id));
        }
        $office->is_suspended = 0;
        $office->save();
        Toastr::success('تمت إعادة فتح المشاريع للجهة ', 'إعادة فتح المشاريع');
        return redirect(url('admin/offices', $office->id));
    }

    public function resume($id)
    {
        $office = Office::findOrFail($id);
        return view('admin.offices.admin_office_resume', compact('office'));
    }

}
