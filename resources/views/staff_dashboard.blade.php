@extends('layouts.staff_app')
@section('title', 'Dashboard')
@section('breadcrumb-main', 'Home')
@section('content')
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body bg-primary text-white">
                    <h4 class="text-center text-white">Total Students</h4>
                    <h1 class="text-center text-white">{{ $stats['total_stu'] }}</h1>
                </div>  
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body bg-info text-white">
                    <h4 class="text-center text-white">Total Staff</h4>
                    <h1 class="text-center text-white">{{ $stats['total_sta'] }}</h1>
                </div>  
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body bg-success text-white">
                    <h4 class="text-center text-white">Total Assigned Students</h4>
                    <h1 class="text-center text-white">{{ $stats['total_assigned'] }}</h1>
                </div>  
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-4 card-title">My Students</h4>
                    <div class="mb-4">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Matric Number</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Field of Interest</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student)
                                        <tr>
                                            <td>{{ $student->student->matric_number }}</td>
                                            <td>{{ $student->student->full_name }}</td>
                                            <td>{{ $student->student->email }}</td>
                                            <td>{{ $student->student->field }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection