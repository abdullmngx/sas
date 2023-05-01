@extends('layouts.auth')
@section('title', 'Register')
@section('content')
<div class="px-3 py-3">
    <div class="text-center">
        <h5 class="mb-0">Register Account</h5>
        <p class="text-muted mt-2">Sign up with your Matric Number.</p>
    </div>
    <form class="mt-4 pt-2" method="post">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <div class="form-floating form-floating-custom mb-3">
                    <input type="text" name="first_name" class="form-control" id="input-username" placeholder="Enter Your first Name">
                    <label for="input-username">First Name</label>
                    <div class="form-floating-icon">
                        <i class="uil uil-users-alt"></i>
                    </div>
                </div>
                @if($errors->has('first_name'))
                    <span class="text-sm text-small text-danger">{{ $errors->first('first_name') }}</span>
                @endif
            </div>
            <div class="col-md-4">
                <div class="form-floating form-floating-custom mb-3">
                    <input type="text" name="middle_name" class="form-control" id="input-username" placeholder="Enter your middle Name">
                    <label for="input-username">Middle Name</label>
                    <div class="form-floating-icon">
                        <i class="uil uil-users-alt"></i>
                    </div>
                </div>
                @if($errors->has('middle_name'))
                    <span class="text-sm text-small text-danger">{{ $errors->first('middle_name') }}</span>
                @endif
            </div>
            <div class="col-md-4">
                <div class="form-floating form-floating-custom mb-3">
                    <input type="text" name="surname" class="form-control" id="input-username" placeholder="Enter Your Last Name">
                    <label for="input-username">Surname</label>
                    <div class="form-floating-icon">
                        <i class="uil uil-users-alt"></i>
                    </div>
                </div>
                @if($errors->has('surname'))
                    <span class="text-sm text-small text-danger">{{ $errors->first('surname') }}</span>
                @endif
            </div>
        </div>
        <div class="form-floating form-floating-custom mb-3">
            <input type="email" name="email" class="form-control" id="input-email" placeholder="Enter Email">
            <div class="invalid-feedback">
                Please Enter Email
            </div> 
            <label for="input-email">Email</label>
            <div class="form-floating-icon">
                <i class="uil uil-envelope-alt"></i>
            </div>
            @if($errors->has('email'))
                    <span class="text-sm text-small text-danger">{{ $errors->first('email') }}</span>
                @endif
        </div>
        <div class="form-floating form-floating-custom mb-3">
            <input type="text" name="matric_number" class="form-control" id="input-username" placeholder="Enter Your Matric Number">
            <label for="input-username">Matric Number</label>
            <div class="form-floating-icon">
                <i class="uil uil-users-alt"></i>
            </div>
            @if($errors->has('matric_number'))
                <span class="text-sm text-small text-danger">{{ $errors->first('matric_number') }}</span>
            @endif
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <select name="level_id" id="level" class="form-control">
                    <option value="">Select Level</option>
                    @foreach ($levels as $level)
                        <option value="{{ $level->id }}">{{ $level->name }}</option>
                    @endforeach
                </select>
                @if($errors->has('level_id'))
                    <span class="text-sm text-small text-danger">{{ $errors->first('level_id') }}</span>
                @endif
            </div>
            <div class="col-md-4">
                <select name="programme_id" id="programme" class="form-control">
                    <option value="">Select Programme</option>
                    @foreach ($programmes as $programme)
                        <option value="{{ $programme->id }}">{{ $programme->name }}</option>
                    @endforeach
                </select>
                @if($errors->has('programme_id'))
                    <span class="text-sm text-small text-danger">{{ $errors->first('programme_id') }}</span>
                @endif
            </div>
            <div class="col-md-4">
                <select name="field_id" id="field" class="form-control">
                    <option value="">Select Field of interest</option>
                    @foreach ($fields as $field)
                        <option value="{{ $field->id }}">{{ $field->name }}</option>
                    @endforeach
                </select>
                @if($errors->has('field_id'))
                    <span class="text-sm text-small text-danger">{{ $errors->first('field_id') }}</span>
                @endif
            </div>
        </div>
        <div class="form-floating form-floating-custom mb-3">
            <input type="password" name="password" class="form-control" id="input-password" placeholder="Enter Password">
            <label for="input-password">Password</label>
            <div class="form-floating-icon">
                <i class="uil uil-padlock"></i>
            </div>
            @if($errors->has('password'))
                    <span class="text-sm text-small text-danger">{{ $errors->first('password') }}</span>
                @endif
        </div>

        <div>
            @if(session()->has('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
        </div>
        <div class="mt-3">
            <button class="btn btn-primary w-100" type="submit">Register</button>
        </div>

        <div class="mt-4 pt-3 text-center">
            <p class="text-muted mb-0">Already have an account ? <a href="/" class="fw-semibold text-decoration-underline"> Login </a> </p>
        </div>

    </form><!-- end form -->
</div>
@endsection