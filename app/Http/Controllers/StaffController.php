<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\Fields;
use App\Models\Staff;
use App\Models\StaffField;
use App\Models\StaffTopic;
use App\Models\Student;
use App\Models\StudentTopic;
use App\Models\StudentUpload;
use App\Models\SupervisorAssignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    public function login()
    {
        return view('auth.staff_login');
    }

    public function register()
    {
        return view('auth.staff_register');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required',
        ]);

        if (Auth::guard('staff')->attempt($request->only('email', 'password'), $request->remember))
        {
            return redirect()->intended(route('staff.dashboard'));
        }

        return back()->withErrors(['email' => 'Incorrect Credentials']);
    }

    public function create(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'surname' => 'required',
            'email' => 'required|email|unique:staff',
            'phone_number' => 'required',
            'password' => 'required',
        ]);

        $staff_info = $request->except('_token', 'password');

        $staff_info['password'] = Hash::make($request->password);

        $staff = Staff::create($staff_info);

        Auth::guard('staff')->login($staff);

        return redirect()->intended(route('staff.dashboard'));
    }

    public function dashboard()
    {
        $session = Configuration::where('name', 'current_session')->first();
        $count_stu = Student::count();
        $count_sta = Staff::count();
        $countAlloc = SupervisorAssignment::where('session_id', $session->value)->count();

        $stat = [
            'total_stu' => $count_stu,
            'total_sta' => $count_sta,
            'total_assigned' => $countAlloc
        ];

        $students = SupervisorAssignment::where('session_id', $session->value)->where('staff_id', auth('staff')->id())->get();
        return view('staff_dashboard', ['students' => $students, 'stats' => $stat]);
    }

    public function myStudents()
    {
        $session = Configuration::where('name', 'current_session')->first();
        $students = SupervisorAssignment::where('session_id', $session->value)->where('staff_id', auth('staff')->id())->get();
        return view('my_students', ['students' => $students]);
    }

    public function topics()
    {
        $session = Configuration::where('name', 'current_session')->first();
        $topics = StaffTopic::where('staff_id', auth('staff')->id())->where('session_id', $session->value)->get();
        return view('staff_topics', ['topics' => $topics]);
    }

    public function config()
    {
        $configs = Configuration::all();
        return view('config', ['configs' => $configs]);
    }

    public function staffs()
    {
        $staffs = Staff::all();
        return view('staffs', ['staffs' => $staffs]);
    }

    public function students()
    {
        $students = Student::all();
        return view('students', ['students' => $students]);
    }

    public function logout()
    {
        Auth::guard('staff')->logout();
        return redirect(route('staff.login'));
    }

    public function fields()
    {
        $fields = Fields::all();
        return view('fields', ['fields' => $fields]);
    }

    public function myFields()
    {
        $session = Configuration::where('name', 'current_session')->first();
        $staff_fields = StaffField::where('staff_id', auth('staff')->id())->where('session_id', $session->value)->get();
        $fields = Fields::all();
        $fields->filter(function ($field) use ($staff_fields) {
            if (!is_null($staff_fields->where('field_id', $field->id)->first()))
            {
                $field->status = 'assigned';
            }
            else
            {
                $field->status = 'unassigned';
            }
        });
        return view('my_fields', ['fields' => $fields]);
    }

    public function studentTopics($student_id)
    {
        $session = Configuration::where('name', 'current_session')->first();
        $student_topics = StudentTopic::where('student_id', $student_id)->where('session_id', $session->value)->get();
        $uploads = StudentUpload::where('student_id', $student_id)->where('session_id', $session->value)->get();
        return view('staff_student_topics', ['topics' => $student_topics, 'uploads' => $uploads]);
    }
}
