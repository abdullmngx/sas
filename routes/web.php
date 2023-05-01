<?php

use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\FieldsController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StaffFieldController;
use App\Http\Controllers\StaffTopicController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [StudentController::class, 'login'])->name('student.login');
Route::post('/login', [StudentController::class, 'authenticate'])->name('student.authenticate');
Route::get('/signup', [StudentController::class, 'register'])->name('student.register');
Route::post('/signup', [StudentController::class, 'create'])->name('student.create');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
    Route::get('/allocation', [StudentController::class, 'allocation'])->name('student.allocation');
    Route::post('/allocation', [StudentController::class, 'allocate'])->name('student.allocate');
    Route::get('/supervisor', [StudentController::class, 'supervisor'])->name('student.supervisor');
    Route::get('/topic/take/{topic_id}', [StudentController::class, 'takeTopic'])->name('student.take_topic');
    Route::get('logout', [StudentController::class, 'logout'])->name('student.logout');
});

Route::prefix('/staff')->group(function () {
    Route::get('/login', [StaffController::class, 'login'])->name('staff.login');
    Route::post('/login', [StaffController::class, 'authenticate'])->name('staff.authenticate');
    Route::get('/signup', [StaffController::class, 'register'])->name('staff.register');
    Route::post('/signup', [StaffController::class, 'create'])->name('staff.create');

    Route::middleware('auth.staff')->group(function () {
        Route::get('/dashboard', [StaffController::class, 'dashboard'])->name('staff.dashboard');
        Route::get('/my-students', [StaffController::class, 'myStudents'])->name('staff.my_students');
        Route::get('/fields/assign/{field_id}', [StaffFieldController::class, 'create'])->name('staff.assign_field');
        Route::get('/fields/unassign/{field_id}', [StaffFieldController::class, 'delete'])->name('staff.assign_field');
        Route::get('my-fields', [StaffController::class, 'myFields'])->name('staff.my_fields');
        Route::get('topics', [StaffController::class, 'topics'])->name('staff.topics');
        Route::post('/topics', [StaffTopicController::class, 'create'])->name('staff.create_topic');
        Route::get('/topics/delete/{topic_id}', [StaffTopicController::class, 'delete'])->name('staff.delete_topic');
        Route::get('/logout', [StaffController::class, 'logout'])->name('staff.logout');


        Route::middleware('admin.auth')->group(function () {
            Route::get('manage-staffs', [StaffController::class, 'staffs'])->name('staff.staffs');
            Route::get('students', [StaffController::class, 'students'])->name('staff.students');
            Route::get('/fields', [StaffController::class, 'fields'])->name('staff.fields');
            Route::post('/fields', [FieldsController::class, 'create'])->name('staff.create_field');
            Route::get('/fields/delete/{field_id}', [FieldsController::class, 'delete'])->name('staff.delete_field');
            Route::get('config', [StaffController::class, 'config'])->name('staff.config');
            Route::post('/config', [ConfigurationController::class, 'save'])->name('staff.save_config');
        });
        
    });

    route::get('unauthorized', function () {
        return view('unauthorized');
    })->name('staff.unauthorized');
});
