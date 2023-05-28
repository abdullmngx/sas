@extends('layouts.app')
@section('title', 'Profile')
@section('breadcrumb-main', 'Home')
@section('content')
    <div class="row mb-4">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-4 card-title">My Profile</h4>
                    <div class="row">
                        <div class="col-md-5">
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
                            <form action="" method="post">
                                @csrf
                                <div class="mb-4">
                                    <label for="fname">First Name</label>
                                    <input type="text" name="first_name" id="fname" class="form-control" value="{{ auth()->user()->first_name }}" readonly>
                                </div>
                                <div class="mb-4">
                                    <label for="mname">Middle Name</label>
                                    <input type="text" name="middle_name" id="mname" class="form-control" value="{{ auth()->user()->middle_name }}" readonly>
                                </div>
                                <div class="mb-4">
                                    <label for="lname">Surname</label>
                                    <input type="text" name="surname" id="lname" class="form-control" value="{{ auth()->user()->surname }}" readonly>
                                </div>
                                <div class="mb-4">
                                    <label for="matric">Matric Number</label>
                                    <input type="text" name="matric_number" id="matric" class="form-control" value="{{ auth()->user()->matric_number }}" readonly>
                                </div>
                                <div class="mb-4">
                                    <label for="field">Field of Interest</label>
                                    <select name="field_id" id="field" class="form-control">
                                        @foreach ($fields as $field)
                                            <option value="{{ $field->id }}" {{ $field->id == auth()->user()->field_id ? 'selected' : ''}}>{{ $field->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection