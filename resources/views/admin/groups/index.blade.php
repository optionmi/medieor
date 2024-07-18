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
                        <h5 class="card-title">Groups</h5>
                        <button class="px-2 py-2 btn btn-primary" type="button" title="Edit" data-coreui-toggle="modal"
                            data-coreui-target="#groupStore">Create</button>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table id="group-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Image</th>
                                <th scope="col">Category</th>
                                <th scope="col">Members</th>
                                <th scope="col">Status</th>
                                <th scope="col">Created on</th>
                                <th scope="col">Created by</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('admin.groups.partials.store')
@endsection

@section('bottom-scripts')
    <script>
        $(document).ready(function() {
            var table = $("#group-table").DataTable({
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
                    url: "{{ route('admin.group.groups.data') }}",
                    data: function(d) {}
                },
                columns: [{
                        data: 'serial',
                        name: '#',
                        sortable: true
                    },
                    {
                        data: 'title',
                        name: 'title',
                        searchable: true,
                        orderable: true,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'description',
                        name: 'description',
                        searchable: true,
                        orderable: true,
                        defaultContent: 'NA',
                        // "width": "40%"
                    },
                    {
                        data: 'image_formated',
                        name: 'image_formated',
                        searchable: false,
                        orderable: false,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'category_title',
                        name: 'Category',
                        searchable: true,
                        orderable: true,
                        defaultContent: 'NA',
                        // "width": "40%"
                    },
                    {
                        data: 'members',
                        name: 'members',
                        searchable: false,
                        orderable: false,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'status_formated',
                        name: 'status_formated',
                        searchable: true,
                        orderable: false,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'created_at_formated',
                        name: 'created_at_formated',
                        searchable: true,
                        orderable: true,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'created_by',
                        name: 'created_by',
                        searchable: false,
                        orderable: false,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        searchable: false,
                        orderable: false,
                        defaultContent: 'NA',
                        // "width": "10%"
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
