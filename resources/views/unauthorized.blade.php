@extends('layouts.staff_app')
@section('title', 'Unauthorized')
@section('breadcrumb-main', 'Home')
@section('content')
    <div class="row mb-4">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <h1 class="mb-4"><i class="fa fa-exclamation-triangle fa-4x text-danger"></i></h1>
                        <h2 class="mb-4">You are not authorized to view this page</h2>
                        <p><a href="{{ route('staff.dashboard') }}" class="btn btn-primary">Return to dashboard</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection