@extends('layouts.coreui')
@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.1/dist/quill.snow.css" rel="stylesheet" />
@endsection

@section('content')
    <div class="body flex-grow-1">
        <div class="px-4 container-lg">
            <div class="mb-4 row card">
                <div class="card-header">
                    <h5>Our Purpose</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.info-pages.aboutus.update', $data->id) }}" method="POST">
                        @csrf
                        <div class="mb-5">
                            <div class="mb-3">
                                <label for="img1" class="form-label">Imgage 1</label>
                                <div class="my-2">
                                    <img id="img1Preview" src="{{ asset($data->img1) }}" alt="" height="200">
                                </div>
                                <input type="file" name="img1" id="img1" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="img_text1" class="form-label">Image Text 1</label>
                                <input type="text" name="img_text1" id="img_text1" class="form-control"
                                    value="{{ $data->img_text1 }}">
                            </div>
                            <div class="mb-3">
                                <label for="heading1" class="form-label">Heading 1</label>
                                <input type="text" name="heading1" id="heading1" class="form-control"
                                    value="{{ $data->heading1 }}">
                            </div>
                            <div class="mb-3">
                                <label for="section1" class="form-label">Section 1</label>
                                <div id="section1">
                                </div>
                                <input type="hidden" name="section1">
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('bottom-scripts')
    <!-- Include the Quill library -->
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.1/dist/quill.js"></script>

    <script>
        const quill1 = new Quill("#section1", {
            theme: "snow",
        });

        quill1.root.innerHTML = @json($data->section1);

        quill1.on('text-change', function(delta, oldDelta, source) {
            $('[name="section1"]').val(quill1.root.innerHTML);
        });

        $('#img1').on('change', function(e) {
            showPreview(e, '#img1Preview');
        })

        function showPreview(e, id) {
            let file = e.target.files[0];
            if (file) {
                var reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = function(e) {
                    var imageUrl = e.target.result;
                    document.querySelector(id).src = imageUrl;
                };
            }
        }
    </script>
@endsection
