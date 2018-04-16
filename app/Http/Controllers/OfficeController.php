<?php

namespace App\Http\Controllers;

use App\Advisor;
use App\Area;
use App\Bank;
use App\City;
use App\Http\Requests\OfficeUpdateRequest;
use App\Libraries\Helpers;
use App\Office;
use Brian2694\Toastr\Facades\Toastr;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use App\Http\Requests\OfficePostRequest;
use Moathdev\Sweetalert;

class OfficeController extends Controller
{
    public function __construct()
    {
        Helpers::setCurrentPage('offices');
        $this->middleware('must_have_office')->except([
            'create',
            'store'
        ]);
        $this->middleware('active');
    }

    /**
     * show the user's office
     * @return response
     */
    public function index()
    {
        $office = Sentinel::getUser()->office;
        return $office;
    }

    public function create()
    {
        if (count(Sentinel::getUser()->office) > 0) {
            return redirect('/office');
        }

        $advisors = Advisor::all(['id', 'name']);
        $banks = Bank::all(['id', 'name']);
        $cities = City::all(['id', 'name']);
        $areas = Area::all(['id', 'name']);
        return view('offices.office_create', compact('advisors', 'banks', 'cities', 'areas'));
    }

    public function store(OfficePostRequest $request)
    {
        $office = new Office();
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
        $office->website = $request->website;
        $office->is_banned = 0;
        $office->is_active = 0;
        $office->is_approved = 0;
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



        $office->save();
        Toastr::success('تم حفط بيانات الجهة', 'إضافة جهة جديدة');
        return redirect('/office');
    }

    public function show()
    {
        Helpers::setCurrentPage('offices');
        $office = Sentinel::getUser()->office;
        if (!count($office)) {
            return redirect('/office/create');
        }
        return view('offices.office_show', compact('office'));


    }

    public function edit()
    {
        $office = Office::where('user_id', Sentinel::getUser()->id)->first();
        if ($office->is_approved == 1) {
            Toastr::warning('عذرا، لا يمكن لك تعديل بيانات الجهة. يمكنك مراسلة المؤسسة لطلب التعديل.', 'تعديل بيانات الجهة');
            return redirect()->back();
        }
        $advisors = Advisor::all(['id', 'name']);
        $banks = Bank::all(['id', 'name']);
        $cities = City::all(['id', 'name']);
        $areas = Area::all(['id', 'name']);

        return view('offices.office_edit', compact('office', 'advisors', 'banks', 'cities', 'areas'));
    }

    public function update(OfficeUpdateRequest $request)
    {
        $office = Office::findOrFail($request->office_id);
        if ($office->is_approved == 1) {
            Toastr::warning('عذرا، لا يسمح لك تعديل بيانات الجهة. يمكنك مراسلة المؤسسة لطلب التعديل.', 'تعديل بيانات الجهة');
            return redirect()->back();
        }
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
        if ($office->is_banned == 1) {
            $office->is_banned = 0;
        }

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
        $office->save();
        Toastr::success('تم حفط بيانات الجهة', 'تعديل الجهة');
        return redirect('/office');
    }
}
