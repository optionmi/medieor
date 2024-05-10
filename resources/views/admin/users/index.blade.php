@extends('layouts.coreui')
@section('content')
    <div class="body flex-grow-1">
        <div class="px-4 container-lg">
            <div class="mb-4 row card">
                <div class="card-body">

                    <div class="tab-content rounded-bottom">
                        <div class="p-3 tab-pane active preview table-responsive" role="tabpanel" id="preview-1007">
                            <table class="table table-striped table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        {{-- <th scope="col">Actions</th> --}}

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            {{-- <td>
                                                <div class="d-flex">
                                                    <button
                                                        class="px-2 py-2 btn btn-link nav-link d-flex align-items-center"
                                                        type="button" title="Edit">
                                                        <svg class="icon icon-lg text-primary">
                                                            <use
                                                                xlink:href="{{ asset('coreui/vendors/@coreui/icons/svg/free.svg#cil-pencil') }}">
                                                            </use>
                                                        </svg>
                                                    </button>
                                                    <button
                                                        class="px-2 py-2 btn btn-link nav-link d-flex align-items-center"
                                                        type="button" title="Delete">
                                                        <svg class="icon icon-lg text-danger">
                                                            <use
                                                                xlink:href="{{ asset('coreui/vendors/@coreui/icons/svg/free.svg#cil-trash') }}">
                                                            </use>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </td> --}}
                                        </tr>
                                    @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
