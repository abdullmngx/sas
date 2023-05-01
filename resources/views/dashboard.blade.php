@extends('layouts.app')
@section('breadcrumb-main', 'Home')
@section('title', 'Dashboard')
@section('content')
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <img src="/assets/images/users/avatar-3.jpg" class="img-fluid w-25 mb-4" style="border-radius: 50%" alt="">
                        <h2>
                            {{ auth()->user()->full_name }}
                        </h2>
                        <h4>{{ auth()->user()->matric_number }}</h4>
                        <hr>
                    </div>
                    <div class="mt-3">
                        <table class="table table-striped table-hover">
                            <tr>
                                <th>Programme</th>
                                <td>{{ auth()->user()->programme }}</td>
                            </tr>
                            <tr>
                                <th>Department</th>
                                <td>{{ auth()->user()->department }}</td>
                            </tr>
                            <tr>
                                <th>Faculty</th>
                                <td>{{ auth()->user()->faculty }}</td>
                            </tr>
                            <tr>
                                <th>Level</th>
                                <td>{{ auth()->user()->level }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">My Supervisor</h4>
                </div>
                <div class="card-body">
                    @if (!auth()->user()->is_assigned)
                        <div class="alert alert-info">
                            You have not been assigned to a supervisor, <a href="/allocation">click here</a> to get allocated.
                        </div>
                    @else
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Supervisor Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ auth()->user()->assignment->staff->full_name }}</td>
                                    <td>{{ auth()->user()->assignment->staff->email }}</td>
                                    <td>{{ auth()->user()->assignment->staff->phone_number }}</td>
                                </tr>
                                <tr>
                                    <th>Field of Interest</th>
                                    <td colspan="2">{{ auth()->user()->field }}</td>
                                </tr>
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection