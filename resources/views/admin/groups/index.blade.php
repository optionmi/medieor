@extends('layouts.admin')

@section('title')
    Homepage
@endsection

@section('page-title')
    Group
@endsection

@section('content')

<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-primary" data-toggle="modal" data-target="#edit-group">Create Group</button>
            </div>
            <div class="card-body">
                <table id="group-table" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Image</th>
                            <th>Created on</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row (main row) -->
@include('admin.groups.partials.create-modal')
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        var table = $("#group-table").DataTable({
            "language": {
                "zeroRecords": "No record(s) found."
            },
            processing: true,
            serverSide: true,
            lengthChange: true,
            order: [0,'asc'],
            searchable:true,
            bStateSave: false,

            ajax: 
            {
                url: "{{route('admin.group.groups.data')}}",
                data: function (d) {
                }   
            },
            columns: [
                { data: 'id', name: 'id', sortable: true},
                { data: 'title', name: 'title', searchable: true, orderable:true ,defaultContent: 'NA'},
                { data: 'description', name: 'description', searchable: true, orderable:true ,defaultContent: 'NA', "width": "40%"},
                { data: 'status_formated', name: 'status_formated', searchable: true, orderable:false ,defaultContent: 'NA'},
                { data: 'image_formated', name: 'image_formated', searchable: false, orderable:false ,defaultContent: 'NA'},
                { data: 'created_at_formated', name: 'created_at_formated', searchable: true, orderable:true,defaultContent: 'NA' },
                { data: 'action', name: 'action', searchable: false, orderable:false ,defaultContent: 'NA', "width": "10%"},
            ],
            columnDefs: [
            {
                "targets": 0,
                "width": "4%"
            },
            {
                "targets": 3,
                "className": "text-center",
            }],
        });

        $('#edit-group').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');

            var id = button.data('id');
            var title = button.data('title');
            var description = button.data('description');
            var status = button.data('status');
            var image_path = button.data('image_path');

            $('#id').val(id);
            $('#title').val(title);
            $('#description').val(description);
            $('input:radio[name="status"][value="'+status+'"]').prop('checked', true);
            $('#image_preview').attr('src', image_path);
        });

        $('#save-group-form').submit(function(e) {
            e.preventDefault();

            var form = $(this);
            var submitUrl = form.attr('action');
            var method = form.attr('method');

            var submitButton = form.find('button[type="submit"]');
            submitButton.html('<i class="fas fa-2x fa-sync-alt fa-spin"></i>');

            var formData = new FormData(this);

            $.ajax({
                url: submitUrl,
                type: method,
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {

                    submitButton.html('Save changes');
                    $('#save-group-form')[0].reset();
                    $('#edit-group').modal('hide');
                    $('#group-table').DataTable().draw();

                    if(data.error == true) {
                        Swal.fire({
                            title: 'Error!',
                            text: data.message,
                            icon: 'error',
                            showConfirmButton: true,
                        }).then((value) => {
                            
                        });
                        return false;
                    } else {
                        Swal.fire({
                            title: 'Success!',
                            text: data.message,
                            icon: 'success',
                            showConfirmButton: true,
                        }).then((value) => {
                            
                        });
                    }
                },
                error: function(error) {
                    submitButton.html('Save changes');
                    console.error('Error:', error);
                }
            });
        });
    });

</script>
@endsection

