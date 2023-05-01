<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\StaffTopic;
use Illuminate\Http\Request;

class StaffTopicController extends Controller
{
    public function create(Request $request)
    {
        $request->validate(['topic' => 'required']);

        $session = $session = Configuration::where('name', 'current_session')->first();

        $staff_id = auth('staff')->id();

        if (StaffTopic::where('topic', $request->topic)->where('session_id', $session->value)->where('staff_id', $staff_id)->exists())
        {
            return back()->withErrors(['error' => 'Topic already exists']);
        }

        StaffTopic::create([
            'topic' => $request->topic,
            'staff_id' => $staff_id,
            'session_id' => $session->value
        ]);

        return back()->with('success', 'Topic Added');
    }

    public function delete($topic_id)
    {
        StaffTopic::destroy($topic_id);
        return back()->with('success', 'Topic deleted');
    }
}
