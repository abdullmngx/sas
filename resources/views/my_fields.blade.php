@extends('layouts.staff_app')
@section('title', 'My Fields')
@section('breadcrumb-main', 'Home')
@section('content')
    <div class="row mb-4">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-4 card-title">My Fields</h4>
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
                                        <th>S/N</th>
                                        <th>Field Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($fields as $field)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $field->name ?? 'NA' }}</td>
                                            <td>{{ $field->status }}</td>
                                            <td>
                                                @if($field->status == 'assigned')
                                                    <a href="/staff/fields/unassign/{{ $field->id }}" class="btn btn-danger">Unassign</a>
                                                @else
                                                    <a href="/staff/fields/assign/{{ $field->id }}" class="btn btn-primary">Assign to me</a>
                                                @endif
                                            </td>
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
