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
                                                        @if ($topic->student_id == auth()->id())
                                                            <a href="{{ route('student.untake_topic', $topic->id) }}" class="btn btn-danger" onclick="return confirm('are you sure you want to untake this topic?')">Untake Topic</a>
                                                        @else
                                                            No Action
                                                        @endif
                                                    @else
                                                        <a href="{{ route('student.take_topic', $topic->id) }}" class="btn btn-success" onclick="return confirm('are you sure you want to take this topic for your project?')">Take Topic</a>
                                                    @endif

                                                    <button class="btn btn-info abs" id="abs" data-abstract="{!! $topic->abstract !!}">show Abstract</button>
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