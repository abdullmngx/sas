<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\StaffUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StaffUploadController extends Controller
{
    public function upload()
    {
        $session = Configuration::where('name', 'current_session')->first();
        $uploads = StaffUpload::where('staff_id', auth('staff')->id())->where('session_id', $session->value)->get();
        return view('upload', ['uploads' => $uploads]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required'
        ]);

        $session = Configuration::where('name', 'current_session')->first();
        $path = $request->file('file')->store('public/uploads');
        $url = Storage::url($path);

        StaffUpload::create([
            'staff_id' => auth('staff')->id(),
            'name' => $request->name,
            'file' => $url,
            'session_id' => $session->value
        ]);

        return back()->with('success', 'upload complete');
    }
}
