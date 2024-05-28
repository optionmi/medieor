@extends('layouts.coreui')
@section('content')
    <div class="body flex-grow-1">
        <div class="px-4 container-lg">
            <div class="mb-4 row card">
                <div class="card-header">
                    <h5 class="card-title">Users</h5>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped table-bordered" data-table-route="{{ route('admin.users.datatable') }}">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- 
@section('bottom-scripts')
    <script>
        $(document).ready(function() {
            $(".table").DataTable({
                "language": {
                    "zeroRecords": "No record(s) found."
                },
                processing: true,
                serverSide: true,
                lengthChange: true,
                order: [0, 'asc'],
                searchable: true,
                bStateSave: false,

                ajax: {
                    url: "{{ route('admin.users.datatable') }}",
                    data: function(d) {}
                },
                columns: [{
                        data: 'serial',
                        name: '#',
                        sortable: true
                    },
                    {
                        data: 'name',
                        name: 'name',
                        searchable: true,
                        orderable: true,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'email',
                        name: 'email',
                        searchable: true,
                        orderable: true,
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
@endsection --}}
