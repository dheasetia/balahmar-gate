<?php

namespace App\Http\Controllers;

use App\City;
use App\Http\Requests\ProposalPostRequest;
use App\Http\Requests\ProposalUpdateRequest;
use App\Kind;
use App\Libraries\Helpers;
use App\Proposal;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;

class ProposalController extends Controller
{
    public function __construct()
    {
        Helpers::setCurrentPage('proposals');
        $this->middleware('must_have_office');
    }
    public function index()
    {
        $office_id = Sentinel::getUser()->office->id;
        $proposals = Proposal::where('office_id', $office_id)->get();
        $seq_num = 0;
        Helpers::setCurrentPage('proposals');
        return view('proposals.proposal_index', compact('proposals', 'seq_num'));
    }

    public function create()
    {
        $kinds = Kind::all('id', 'name');
        $cities = City::all('id', 'name');
        return view('proposals.proposal_create', compact('kinds', 'cities'));
    }

    public function store(ProposalPostRequest $request)
    {
        $array_hijri = explode('/ ', $request->input('hijri_created'));

        $array_execution_hijri = explode('/ ', $request->input('execution_date'));


        $proposal = new Proposal();
        $proposal->project_name = $request->project_name;
        $proposal->description = $request->description;
        $proposal->hijri_created_day = $array_hijri[0];
        $proposal->hijri_created_month = $array_hijri[1];
        $proposal->hijri_created_year = $array_hijri[2];

        $proposal->responsible_person = $request->responsible_person;
        $proposal->mobile = $request->mobile;
        $proposal->email = $request->email;
        $proposal->office_id = Sentinel::getUser()->office->id;
        $proposal->user_id = Sentinel::getUser()->id;
        $proposal->kind_id = $request->kind_id;
        $proposal->city_id = $request->city_id;
        $proposal->hijri_execution_day = $array_execution_hijri[0];
        $proposal->hijri_execution_month = $array_execution_hijri[1];
        $proposal->hijri_execution_year = $array_execution_hijri[2];

        if ($request->hasFile('document_path')) {
            $now = time() . '_';
            $document = $request->file('document_path');
            $destination = public_path('files_proposals/');
            $file_name = $now . $document->getClientOriginalName();
            if ($document->move($destination, $file_name)) {
                $proposal->document_path = $file_name;
            }
        }

        $proposal->save();
        flash('تقديم طلب مشروع', 'تمت إرسال الطلب', 'success');
        return redirect('/proposals');
    }

    public function show($id)
    {
        $proposal = Proposal::findOrFail($id);
        Helpers::setCurrentPage('proposals');
        $kinds = Kind::all('id', 'name');
        $cities = City::all('id', 'name');
        return view('proposals.proposal_show', compact('proposal','kinds', 'cities'));
    }
    public function edit($id)
    {
        $proposal = Proposal::findOrFail($id);
        $kinds = Kind::all('id', 'name');
        $cities = City::all('id', 'name');
        Helpers::setCurrentPage('proposals');
        return view('proposals.proposal_edit', compact('proposal', 'kinds', 'cities'));
    }
    
    public function update(ProposalUpdateRequest $request, $id)
    {
        $proposal = Proposal::findOrFail($id);
        $array_hijri = explode('/ ', $request->input('hijri_created'));

        $array_execution_hijri = explode('/ ', $request->input('execution_date'));

        $proposal->project_name = $request->project_name;
        $proposal->description = $request->description;
        $proposal->hijri_created_day = $array_hijri[0];
        $proposal->hijri_created_month = $array_hijri[1];
        $proposal->hijri_created_year = $array_hijri[2];

        $proposal->responsible_person = $request->responsible_person;
        $proposal->mobile = $request->mobile;
        $proposal->email = $request->email;
        $proposal->office_id = Sentinel::getUser()->office->id;
        $proposal->user_id = Sentinel::getUser()->id;
        $proposal->kind_id = $request->kind_id;
        $proposal->city_id = $request->city_id;
        $proposal->video_link = $request->video_link;
        $proposal->hijri_execution_day = $array_execution_hijri[0];
        $proposal->hijri_execution_month = $array_execution_hijri[1];
        $proposal->hijri_execution_year = $array_execution_hijri[2];

        if ($request->hasFile('document_path')) {
            $now = time() . '_';
            $document = $request->file('document_path');
            $destination = public_path('files_proposals/');
            $file_name = $now . $document->getClientOriginalName();
            if ($document->move($destination, $file_name)) {
                $proposal->document_path = $file_name;
            }
        }

        $proposal->save();
        flash('تعديل طلب مشروع', 'تم تعديل طلب المشروع', 'success');
        return redirect(url('/proposals', $proposal->id));
    }
}
