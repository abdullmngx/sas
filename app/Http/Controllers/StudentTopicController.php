<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\StudentTopic;
use Illuminate\Http\Request;

class StudentTopicController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'topic' => 'required',
            'abstract' => 'required'
        ]);

        $session = $session = Configuration::where('name', 'current_session')->first();

        $student_id = auth()->id();

        if (StudentTopic::where('topic', $request->topic)->where('session_id', $session->value)->where('student_id', $student_id)->exists())
        {
            return back()->withErrors(['error' => 'You\'ve already submitted this topic for approval']);
        }

        StudentTopic::create([
            'student_id' => $student_id,
            'session_id' => $session->value,
            'topic' => $request->topic,
            'abstract' => $request->abstract
        ]);

        return back()->with('success', 'Topic submitted for approval');
    }

    public function approve($topic_id)
    {
        StudentTopic::where('id', $topic_id)->update(['status' => 'approved']);
        return back()->with('success', 'Topic approved');
    }

    public function decline($topic_id)
    {
        StudentTopic::where('id', $topic_id)->update(['status' => 'declined']);
        return back()->with('success', 'Topic declined');
    }
}
