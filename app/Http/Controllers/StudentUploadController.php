<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\StudentUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentUploadController extends Controller
{
    public function upload()
    {
        $session = Configuration::where('name', 'current_session')->first();
        $uploads = StudentUpload::where('student_id', auth()->id())->where('session_id', $session->value)->get();
        return view('student_upload', ['uploads' => $uploads]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required'
        ]);

        $session = Configuration::where('name', 'current_session')->first();
        $path = $request->file('file')->store('public/uploads');
        $url = Storage::url($path);

        StudentUpload::create([
            'student_id' => auth()->id(),
            'name' => $request->name,
            'file' => $url,
            'session_id' => $session->value
        ]);

        return back()->with('success', 'upload complete');
    }
}
