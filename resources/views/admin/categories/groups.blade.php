@extends('layouts.admin')

@section('title')
    Homepage
@endsection

@section('page-title')
    Groups by Category
@endsection

@section('content')

<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <label>Choose Category</label>
                <select class="form-control select2" style="width: 100%;" id="categories-list">
                    <option selected="selected" value="" disabled>select one</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                </select>
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

<script>
    $(document).ready(function() {
        

        $('#categories-list').on('change', function() {

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
                    url: "{{route('admin.categories.groups.byid')}}",
                    data: function (d) {
                        d.category = $('#categories-list').val();
                    }   
                },
                columns: [
                    { data: 'id', name: 'id', sortable: true},
                    { data: 'title', name: 'title', searchable: true, orderable:true ,defaultContent: 'NA'},
                    { data: 'description', name: 'description', searchable: true, orderable:true ,defaultContent: 'NA', "width": "40%"},
                    { data: 'status_formated', name: 'status_formated', searchable: true, orderable:false ,defaultContent: 'NA'},
                    { data: 'image_formated', name: 'image_formated', searchable: true, orderable:false ,defaultContent: 'NA'},
                    { data: 'created_at_formated', name: 'created_at_formated', searchable: true, orderable:true,defaultContent: 'NA' },
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
            table.draw();
            console.log('slkjsksjk')
        });
    });

</script>
@endsection

