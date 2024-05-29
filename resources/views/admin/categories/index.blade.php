@extends('layouts.coreui')
@section('styles')
    <style>
        .logo-img {
            border-radius: 50%
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.1/dist/quill.snow.css" rel="stylesheet" />
@endsection


@section('content')
    <div class="body flex-grow-1">
        <div class="px-4 container-lg">
            <div class="mb-4 row card">
                <div class="card-header">
                    <h5 class="card-title">Categories</h5>

                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped table-bordered dataTable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Logo</th>
                                <th scope="col">Banner</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('admin.categories.edit')
@endsection

@section('bottom-scripts')
    <script>
        $(document).ready(function() {
            var table = $(".dataTable").DataTable({
                "language": {
                    "zeroRecords": "No record(s) found."
                },
                processing: false,
                serverSide: true,
                lengthChange: true,
                order: [0, 'asc'],
                searchable: false,
                bStateSave: false,
                searching: false,
                lengthChange: false,
                // paging: false,

                ajax: {
                    url: "{{ route('admin.categories.data') }}",
                    data: function(d) {}
                },
                columns: [{
                        data: 'serial',
                        name: '#',
                        sortable: false
                    },
                    {
                        data: 'title',
                        name: 'title',
                        searchable: false,
                        orderable: false,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'description',
                        name: 'description',
                        searchable: true,
                        orderable: false,
                        defaultContent: 'NA',
                    },
                    {
                        data: 'logo',
                        name: 'logo',
                        searchable: false,
                        orderable: false,
                        defaultContent: 'NA',
                    },
                    {
                        data: 'banner',
                        name: 'banner',
                        searchable: false,
                        orderable: false,
                        defaultContent: 'NA',
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        searchable: false,
                        orderable: false,
                        defaultContent: 'NA',
                    },
                ],
            });
        });
    </script>
    <!-- Include the Quill library -->
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.1/dist/quill.js"></script>

    <script>
        const quill1 = new Quill("#description", {
            theme: "snow",
        });
        $('.modal').on('shown.coreui.modal', function() {
            quill1.root.innerHTML = $('#hiddenDescription').val();
            quill1.on('text-change', function(delta, oldDelta, source) {
                $('#hiddenDescription').val(quill1.root.innerHTML);
            });
        });
    </script>
@endsection
