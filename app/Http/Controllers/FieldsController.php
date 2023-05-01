<?php

namespace App\Http\Controllers;

use App\Models\Fields;
use Illuminate\Http\Request;

class FieldsController extends Controller
{
    public function create(Request $request)
    {
        $request->validate(['name' => 'required']);

        Fields::create($request->only('name'));

        return back()->with('success', 'field added!');
    }

    public function delete($field_id)
    {
        Fields::destroy($field_id);
        return back()->with('success', 'field deleted!');
    }
}
