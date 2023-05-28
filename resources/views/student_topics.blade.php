@extends('layouts.app')
@section('title', 'Topics')
@section('breadcrumb-main', 'Home')
@section('content')
    <div class="row mb-4">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-4 card-title">Topics</h4>
                    <div class="mb-4">
                        <a href="javascript:void" data-bs-toggle="modal" data-bs-target="#topModal" class="btn btn-primary">Submit new Topic</a>
                    </div>
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
                                            <td>{{ $topic->status ?? 'NA' }}</td>
                                            <td><button class="btn btn-info abs" id="abs" data-abstract="{!! $topic->abstract !!}">show Abstract</button></td>
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
    <div class="modal fade" id="topModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Submit Topic</h4>
                    <a href="javascript:void" class="btn-close" data-bs-dismiss="modal"></a>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        @csrf
                        <div class="mb-4">
                            <label for="topic">Topic</label>
                            <input type="text" name="topic" id="topic" class="form-control" placeholder="Enter topic here">
                        </div>
                        <div class="mb-4">
                            <label for="abstract">Abstract</label>
                            <textarea name="abstract" id="abstract"  class="form-control smnote"></textarea>
                        </div>
                        <div class="mb-4">
                            <button type="submit" class="btn btn-primary">
                                Submit for approval
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
        $(document).ready(function () {
            $('#abstract').summernote()
        })

        $('body').on('click', '.abs' , function () {
            let abs = $(this).data('abstract')
            $('.abs-show').html(abs)

            let absModal = document.getElementById('absModal')
            let modal = new bootstrap.Modal(absModal)
            modal.show()
        })
    </script>
@endsection