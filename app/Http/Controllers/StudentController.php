<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\Fields;
use App\Models\Level;
use App\Models\Programme;
use App\Models\StaffField;
use App\Models\StaffTopic;
use App\Models\Student;
use App\Models\StudentTopic;
use App\Models\SupervisorAssignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function login()
    {
        return view('auth.student_login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => 'required',
        ]);

        $student = Student::where('matric_number', $request->username)->first();

        if ($student && Hash::check($request->password, $student->password))
        {
            Auth::login($student, $request->remember);
            return redirect()->intended(route('student.dashboard'));
        }

        return back()->withErrors(['username' => 'incorrect credentials']);
    }

    public function register()
    {
        $levels = Level::all();
        $programmes = Programme::all();
        $fields = Fields::all();
        return view('auth.student_register', ['levels' => $levels, 'programmes'=>$programmes, 'fields' => $fields]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'surname' => 'required',
            'email' => 'required|email|unique:students',
            'matric_number' => 'required|unique:students',
            'field_id' => 'required',
            'level_id' => 'required',
            'programme_id' => 'required',
            'password' => 'required'
        ]);

        $student_info = $request->except('_token', 'password');
        $password = Hash::make($request->password);
        $programme = Programme::find($request->programme_id);
        $student_info['password'] = $password;
        $student_info['department_id'] = $programme->department_id;
        $student_info['faculty_id'] = $programme->faculty_id;
        $student = Student::create($student_info);
        Auth::login($student);
        return redirect(route('student.dashboard'));
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function allocation()
    {
        return view('allocation');
    }

    public function allocate(Request $request)
    {
        $student_id = $request->student_id;
        $session = Configuration::where('name', 'current_session')->first();
        if (auth()->user()->is_assigned)
        {
            return back()->withErrors(['error' => 'You are already assigned to a supervisor']);
        }

        $config = Configuration::where('name', 'students_per_staff')->first();
        $alloc_conf = Configuration::where('name', 'open_allocation')->first();
        $field_id = auth()->user()->field_id;
        $session_id = $session->value;
        $staffs = StaffField::where('field_id', $field_id)->where('session_id', $session_id)->get();

        if ($alloc_conf->value == 'true')
        {
            if ($staffs->count() > 0)
            {
                foreach($staffs as $staff)
                {
                    $allocated = SupervisorAssignment::where('staff_id', $staff->staff_id)->where('session_id', $session_id)->count();
                    if ($allocated < $config->value)
                    {
                        SupervisorAssignment::create([
                            'student_id' => $student_id,
                            'staff_id' => $staff->staff_id,
                            'session_id' => $session_id
                        ]);

                        return back()->with('success', 'You have been allocated successfully');
                    }
                    else
                    {
                        return back()->withErrors(['error' => 'No staff found or staff allocation limit exceeded!']);
                    }
                }
            }
            else
            {
                return back()->withErrors(['error' => 'Something went wrong please try again later']);
            }
        }

        return back()->withErrors(['error' => 'Allocation is closed at the moment']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('student.login'));
    }


    public function supervisor()
    {
        $session = Configuration::where('name', 'current_session')->first();
        $staff_id = auth()->user()->assignment->staff_id ?? 0;
        $topics = StaffTopic::where('staff_id', $staff_id)->where('session_id', $session->value)->get();
        return view('my_supervisor', ['topics' => $topics]);
    }

    public function takeTopic($topic_id)
    {
        $session = Configuration::where('name', 'current_session')->first();
        if (StaffTopic::where('student_id', auth()->id())->where('session_id', $session->value)->exists())
        {
            return back()->withErrors(['error' => 'You have already taken a topic']);
        }

        StaffTopic::where('id', $topic_id)->update(['student_id' => auth()->id()]);
        return back()->with('success', 'Topic has been assigned to you');
    }

    public function untakeTopic($topic_id)
    {
        $session = Configuration::where('name', 'current_session')->first();
        if (StaffTopic::where('student_id', auth()->id())->where('id', $topic_id)->exists())
        {
            StaffTopic::where('id', $topic_id)->update(['student_id' => null]);
            return back()->with('success', 'Topic has been unassigned!');   
        }
        return back()->withErrors(['error' => 'it seems you have not taken this topic or it was taken by someone else']);
    }

    public function topics()
    {
        $session = Configuration::where('name', 'current_session')->first();
        $topics = StudentTopic::where('student_id', auth()->id())->where('session_id', $session->value)->get();
        return view('student_topics', ['topics' => $topics]);
    }

    public function profile()
    {
        $fields = Fields::all();
        return view('student_profile', ['fields' => $fields]);
    }

    public function updateProfile(Request $request)
    {
        Student::where('id', auth()->id())->update($request->except('_token'));
        return back()->with('success', 'Profile Updated');
    }
}
