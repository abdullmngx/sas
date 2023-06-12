@extends('layouts.staff_app')
@section('title', 'Topics')
@section('breadcrumb-main', 'Home')
@section('content')
    <div class="row mb-4">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-4 card-title">Topics</h4>
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
                                            <td>{{ $topic->status }}</td>
                                            <td><button class="btn btn-info abs" id="abs" data-abstract="{!! $topic->abstract !!}">show Abstract</button> <a href="{{ route('staff.approve_student_topic', $topic->id) }}" class="btn btn-success" onclick="return confirm('are you sure you want to approve this topic?')">Approve</a> <a href="{{ route('staff.decline_student_topic', $topic->id) }}" class="btn btn-danger" onclick="return confirm('are you sure you want to decline this topic?')">Decline</a> </td>
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
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <h4 class="card-title">
                            Project Uploads
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
    </div>
@endsection

@section('modals')
    <div class="modal fade" id="absModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Abstract</h4>
                    <a href="javascript:void" class="btn-close" data-bs-dismiss="modal"></a>
                </div>
                <div class="modal-body">
                    <div class="abs-show"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('body').on('click', '.abs' , function () {
            let abs = $(this).data('abstract')
            $('.abs-show').html(abs)

            let absModal = document.getElementById('absModal')
            let modal = new bootstrap.Modal(absModal)
            modal.show()
        })
    </script>
@endsection