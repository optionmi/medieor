@extends('layouts.coreui')
@section('styles')
@endsection

@section('content')
    <div class="body flex-grow-1">
        <div class="px-4 container-lg">
            <div class="mb-4 row card">
                <div class="card-header">
                    <h5 class="card-title">Group Join Requests</h5>
                    {{-- <label>Select Group</label>
                    <select class="form-control select2" style="width: 100%;" id="group-list">
                        <option selected="selected" value="" disabled>select one</option>
                        @foreach ($groups as $group)
                            <option value="{{ $group->id }}">{{ $group->title }}</option>
                        @endforeach
                    </select> --}}
                </div>
                <div class="card-body table-responsive">
                    <table id="group-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Group</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('bottom-scripts')
    <script>
        $(document).ready(function() {
            // $('#group-list').on('change', function() {
            var table = $("#group-table").DataTable({
                "language": {
                    "zeroRecords": "No record(s) found."
                },
                "bDestroy": true,
                processing: true,
                serverSide: true,
                lengthChange: true,
                order: [0, 'asc'],
                searchable: true,
                bStateSave: false,
                ajax: {
                    url: "{{ route('admin.group.join.request.data') }}",
                    // data: function(d) {
                    //     d.group_id = $('#group-list').val();
                    // }
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
                        data: 'group_title',
                        name: 'group',
                        searchable: true,
                        orderable: true,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        searchable: false,
                        orderable: false,
                        defaultContent: 'NA'
                    },
                ],
                // columnDefs: [{
                //         "targets": 0,
                //         "width": "4%"
                //     },
                //     {
                //         "targets": 2,
                //         "className": "text-center",
                //     }
                // ],
            });
            // table.draw();
            // });

            $(document).on('change', '.join-request-radio', function() {
                // Get the selected value
                var selectedValue = $(this).val();
                const row = $(this).parents('tr');

                // Make AJAX request
                $.ajax({
                    url: "{{ route('admin.group.join.request.toggle') }}",
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        status: selectedValue,
                        user_id: $(this).data('user'),
                        group_id: $(this).data('group')
                    },

                    success: function(data) {
                        if (data.error == false) {
                            // Swal.fire({
                            //     title: 'Success!',
                            //     text: data.message,
                            //     icon: 'success',
                            //     showConfirmButton: true,
                            // }).then((value) => {
                            // });
                            toastr.success(data.message);
                            row.remove();
                        } else {
                            console.log(data)
                        }
                    },
                    error: function(error) {
                        // Handle error
                        console.error(error);
                    }
                });
            });
        });
    </script>
@endsection
