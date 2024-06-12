@extends('layouts.coreui')
@section('styles')
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
                        data: 'category.title',
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

            // $('#edit-group').on('show.bs.modal', function(event) {
            //     var button = $(event.relatedTarget);
            //     var id = button.data('id');

            //     var id = button.data('id');
            //     var title = button.data('title');
            //     var description = button.data('description');
            //     var status = button.data('status');
            //     var image_path = button.data('image_path');

            //     $('#id').val(id);
            //     $('#title').val(title);
            //     $('#description').val(description);
            //     $('input:radio[name="status"][value="' + status + '"]').prop('checked', true);
            //     $('#image_preview').attr('src', image_path);
            // });

            // $('#save-group-form').submit(function(e) {
            //     e.preventDefault();

            //     var form = $(this);
            //     var submitUrl = form.attr('action');
            //     var method = form.attr('method');

            //     var submitButton = form.find('button[type="submit"]');
            //     submitButton.html('<i class="fas fa-2x fa-sync-alt fa-spin"></i>');

            //     var formData = new FormData(this);

            //     $.ajax({
            //         url: submitUrl,
            //         type: method,
            //         data: formData,
            //         contentType: false,
            //         processData: false,
            //         success: function(data) {

            //             submitButton.html('Save changes');
            //             $('#save-group-form')[0].reset();
            //             $('#edit-group').modal('hide');
            //             $('#group-table').DataTable().draw();

            //             if (data.error == true) {
            //                 Swal.fire({
            //                     title: 'Error!',
            //                     text: data.message,
            //                     icon: 'error',
            //                     showConfirmButton: true,
            //                 }).then((value) => {

            //                 });
            //                 return false;
            //             } else {
            //                 Swal.fire({
            //                     title: 'Success!',
            //                     text: data.message,
            //                     icon: 'success',
            //                     showConfirmButton: true,
            //                 }).then((value) => {

            //                 });
            //             }
            //         },
            //         error: function(error) {
            //             submitButton.html('Save changes');
            //             console.error('Error:', error);
            //         }
            //     });
            // });
        });
    </script>
@endsection
