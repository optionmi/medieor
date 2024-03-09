@extends('layouts.admin')

@section('title')
    Homepage
@endsection

@section('page-title')
    Groups join request
@endsection

@section('content')

<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <label>Select Group</label>
                <select class="form-control select2" style="width: 100%;" id="group-list">
                    <option selected="selected" value="" disabled>select one</option>
                    @foreach($groups as $group)
                    <option value="{{ $group->id }}">{{ $group->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="card-body">
                <table id="group-table" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Status</th>
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

@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        

        $('#group-list').on('change', function() {

            var table = $("#group-table").DataTable({
                "language": {
                    "zeroRecords": "No record(s) found."
                },
                "bDestroy": true,
                processing: true,
                serverSide: true,
                lengthChange: true,
                order: [0,'asc'],
                searchable:true,
                bStateSave: false,
                ajax: 
                {
                    url: "{{route('admin.group.join.request.data')}}",
                    data: function (d) {
                        d.group_id = $('#group-list').val();
                    }   
                },
                columns: [
                    { data: 'id', name: 'id', sortable: true},
                    { data: 'name', name: 'name', searchable: true, orderable:true ,defaultContent: 'NA'},
                    { data: 'image_formated', name: 'image_formated', searchable: true, orderable:false ,defaultContent: 'NA'},
                ],
                columnDefs: [
                {
                    "targets": 0,
                    "width": "4%"
                },
                {
                    "targets": 2,
                    "className": "text-center",
                }],
            });
            table.draw();
        });

        $(document).on('change', '.join-request-radio', function () {
            // Get the selected value
            var selectedValue = $(this).val();

            // Make AJAX request
            $.ajax({
                url: "{{ route('admin.group.join.request.toggle')}}",
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: { 
                    status: selectedValue,
                    user_id: $(this).data('user'),
                    group_id: $(this).data('group')
                },
                success: function (data) {
                    if(data.error == false) {
                        Swal.fire({
                            title: 'Success!',
                            text: data.message,
                            icon: 'success',
                            showConfirmButton: true,
                        }).then((value) => {
                            
                        });
                    } else {
                        console.log(data)
                    }
                },
                error: function (error) {
                    // Handle error
                    console.error(error);
                }
            });
        });
    });

</script>
@endsection

