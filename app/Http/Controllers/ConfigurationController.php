<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    public function save(Request $request)
    {
        $names = $request->names;
        $values = $request->values;

        $count = count($names);

        for ($x = 0; $x< $count; $x++)
        {
            Configuration::where('name', $names[$x])->update(['value' => $values[$x]]);
        }

        return back()->with('success', 'Config saved!');
    }
}
