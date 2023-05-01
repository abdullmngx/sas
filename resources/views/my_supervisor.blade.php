@extends('layouts.app')
@section('breadcrumb-main', 'Home')
@section('title', 'My Supervisor')
@section('content')
    <div class="row">
        <div class="col-md-4">
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
                        <div class="table-responsive mb-4">
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
                        </div>
                        <div class="mb-4">
                            <h4 class="card-title mb-4">My Topic</h4>
                            @if (is_null(auth()->user()->topic))
                                <div class="alert alert-info">You have not taken any topic from suggestions</div>
                            @else
                                <h3>{{ auth()->user()->topic->topic }}</h3>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-4 card-title">Suggested Topics</h4>
                    @if(auth()->user()->is_assigned)
                        <div class="mb-4">
                            @if (session()->has('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            @if ($errors->any())
                                @foreach ($errors->all() as $err)
                                    <div class="alert alert-danger">{{ $err }}</div>
                                @endforeach
                            @endif
                        </div>
                        <div class="mb-4">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>Topic</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($topics as $topic)
                                            <tr>
                                                <td>{{ $topic->topic }}</td>
                                                <td>{{ is_null($topic->student_id) ? 'Available' : 'taken' }}</td>
                                                <td>
                                                    @if (!is_null($topic->student_id))
                                                        No Action
                                                    @else
                                                        <a href="{{ route('student.take_topic', $topic->id) }}" class="btn btn-success" onclick="return confirm('are you sure you want to take this topic for your project?')">Take Topic</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-info">
                            Suggested Topics will appear when you are assigned to a supervisor
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection