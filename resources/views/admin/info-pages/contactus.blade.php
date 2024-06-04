@extends('layouts.coreui')
@section('styles')
@endsection

@section('content')
    <div class="body flex-grow-1">
        <div class="px-4 container-lg">
            <div class="mb-4 row card">
                <div class="card-header">
                    <h5>Contact Us</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.info-pages.contactus.update', $data->id) }}" method="POST">
                        @csrf
                        <div class="mb-5">
                            <div class="mb-3">
                                <label for="img_text1" class="form-label">Image Text 1</label>
                                <input type="text" name="img_text1" id="img_text1" class="form-control"
                                    value="{{ $data->img_text1 }}">
                            </div>
                            <div class="mb-3">
                                <label for="section1" class="form-label">Address</label>
                                <input type="text" name="section1" id="section1" class="form-control"
                                    value="{{ $data->section1 }}">
                            </div>
                            <div class="mb-3">
                                <label for="section2" class="form-label">Email</label>
                                <input type="text" name="section2" id="section2" class="form-control"
                                    value="{{ $data->section2 }}">
                            </div>
                            <div class="mb-3">
                                <label for="section3" class="form-label">Phone</label>
                                <input type="text" name="section3" id="section3" class="form-control"
                                    value="{{ $data->section3 }}">
                            </div>
                        </div>

                        <div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection

    @section('bottom-scripts')
    @endsection
