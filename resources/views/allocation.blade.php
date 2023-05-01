@extends('layouts.app')
@section('title', 'Allocation')
@section('breadcrumb-main', 'Home')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Allocation</h4>
                    
                    <div class="mt-4">
                        @if (auth()->user()->is_assigned)
                            <div class="mb-4">
                                @if(session()->has('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif  
                            </div>
                            <div class="mb-4">
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
                        @else
                            <div class="alert alert-info mb-4">
                                You have no allocation record click the button below to be assigned to a supervisor.
                            </div>
                            @if ($errors->any())
                                @foreach ($errors->all() as $err)
                                    <div class="alert alert-danger">{{ $err }}</div>
                                @endforeach    
                            @endif
                            <div class="mb-4">
                                <form action="" method="post">
                                    @csrf
                                    <input type="hidden" name="student_id" value="{{ auth()->id() }}">
                                    <button type="submit" class="btn btn-primary">Find Allocation</button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection