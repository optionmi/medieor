@extends('layouts.coreui')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.1/dist/quill.snow.css" rel="stylesheet" />
@endsection

@section('content')
    <div class="body flex-grow-1">
        <div class="px-4 container-lg">
            <div class="mb-4 row card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title">Category Posts</h5>
                        <button class="px-2 py-2 btn btn-primary" type="button" title="Edit" data-coreui-toggle="modal"
                            data-coreui-target="#categoryPostStore">Create</button>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped table-bordered"
                        data-table-route="{{ route('admin.category.posts.datatable') }}">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Body</th>
                                <th scope="col">Category</th>
                                <th scope="col">Topic</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('admin.category-posts.store')
@endsection
@section('bottom-scripts')
    <!-- Include the Quill library -->
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.1/dist/quill.js"></script>

    <script>
        const quill1 = new Quill("#body", {
            theme: "snow",
        });
        $('.modal').on('show.coreui.modal', function() {
            quill1.root.innerHTML = $('#hiddenBody').val();
            quill1.on('text-change', function(delta, oldDelta, source) {
                $('#hiddenBody').val(quill1.root.innerHTML);
            });
        });
    </script>
@endsection
