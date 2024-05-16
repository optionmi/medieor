@extends('layouts.coreui')
@section('styles')
    <style>
        .logo-img {
            border-radius: 50%
        }
    </style>
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
                        // "width": "40%"
                    },
                    {
                        data: 'logo',
                        name: 'logo',
                        searchable: false,
                        orderable: false,
                        defaultContent: 'NA',
                        // "width": "40%"
                    },
                    {
                        data: 'banner',
                        name: 'banner',
                        searchable: false,
                        orderable: false,
                        defaultContent: 'NA',
                        // "width": "40%"
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        searchable: false,
                        orderable: false,
                        defaultContent: 'NA',
                        // "width": "10%"
                    },
                ],
                // columnDefs: [{
                //         "targets": 0,
                //         "width": "4%"
                //     },
                //     {
                //         "targets": 3,
                //         "className": "text-center",
                //     }
                // ],
            });
        });
    </script>
@endsection
