<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadPictureRequest;
use App\ReportPicture;
use Illuminate\Http\Request;

class PictureController extends Controller
{
    public function store(UploadPictureRequest $request)
    {
        $report_id = $request->report_id;
        $picture = new ReportPicture();
        $picture->report_id = $report_id;
        $picture->title = $request->title;
        $picture->description = $request->description;

        if($request->hasFile('path')){
            $now = time() . '_';
            $document = $request->file('path');
            $destination = public_path('files_pictures/');
            $file_name = $now . $document->getClientOriginalName();
            if ($document->move($destination, $file_name)) {
                $picture->path = $file_name;
                $picture->save();
            }
        }

        flash('رفغ الصورة', 'تم رفع الصوورة', 'success');
        return redirect(url('reports',$report_id));
    }
}
