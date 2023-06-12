@extends('layouts.app')
@section('title', 'Project Upload')
@section('content')
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <h4 class="card-title">
                            My uploads
                        </h4>
                    </div>
                    <div class="mb-4">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Name</th>
                                        <th>file</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($uploads as $upload)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $upload->name }}</td>
                                            <td><a href="{{ $upload->file }}" download="{{ $upload->name }}">Download file</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <h4 class="card-title">Upload</h4>
                    </div>
                    <div class="mb-4">
                        <form method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label for="name">Upload Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="E.g Project Document">
                            </div>
                            <div class="mb-4">
                                <label for="file">File</label>
                                <input type="file" name="file" id="file" class="form-control">
                            </div>
                            @if (session()->has('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            <div class="mb-4">
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection