<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\StaffField;
use Illuminate\Http\Request;

class StaffFieldController extends Controller
{
    public function create($field_id)
    {
        $staff_id = auth('staff')->id();
        $session = Configuration::where('name', 'current_session')->first();
        
        if (StaffField::where('field_id', $field_id)->where('staff_id', $staff_id)->where('session_id', $session->value)->exists())
        {
            return back()->withErrors(['error' => 'Field is already assigned to you']);
        }

        StaffField::create([
            'field_id' => $field_id,
            'staff_id' => $staff_id,
            'session_id' => $session->value
        ]);

        return back()->with('success', 'Field assigned!');
    }

    public function delete($field_id)
    {
        $staff_id = auth('staff')->id();
        $session = Configuration::where('name', 'current_session')->first();

        StaffField::where('field_id', $field_id)->where('staff_id', $staff_id)->where('session_id', $session->value)->delete();

        return back()->with('success', 'Field unassigned!');
    }
}
