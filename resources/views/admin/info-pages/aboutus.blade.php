@extends('layouts.coreui')
@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.1/dist/quill.snow.css" rel="stylesheet" />
@endsection

@section('content')
    <div class="body flex-grow-1">
        <div class="px-4 container-lg">
            <div class="mb-4 row card">
                <div class="card-header">
                    <h5>About Us</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.info-pages.aboutus.update', $data->id) }}" method="POST">
                        @csrf
                        <div class="mb-5">
                            <div class="mb-3">
                                <label for="img1" class="form-label">Image 1</label>
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
                        <div class="mb-5">
                            <div class="mb-3">
                                <label for="img2" class="form-label">Image 2</label>
                                <div class="my-2">
                                    <img id="img2Preview" src="{{ asset($data->img2) }}" alt="" height="200">
                                </div>
                                <input type="file" name="img2" id="img2" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="img_text2" class="form-label">Image Text 2</label>
                                <input type="text" name="img_text2" id="img_text2" class="form-control"
                                    value="{{ $data->img_text2 }}">
                            </div>
                            <div class="mb-3">
                                <label for="heading2" class="form-label">Heading 2</label>
                                <input type="text" name="heading2" id="heading2" class="form-control"
                                    value="{{ $data->heading2 }}">
                            </div>
                            <div class="mb-3">
                                <label for="section2" class="form-label">Section 2</label>
                                <div id="section2">
                                </div>
                                <input type="hidden" name="section2">
                            </div>
                        </div>
                        <div class="mb-5">
                            {{-- <div class="mb-3">
                                <label for="img3" class="form-label">Image 3</label>
                                <div class="my-2">
                                    <img id="img3Preview" src="{{ asset($data->img3) }}" alt="" height="200">
                                </div>
                                <input type="file" name="img3" id="img3" class="form-control">
                            </div> --}}
                            <div class="mb-3">
                                <label for="img_text3" class="form-label">Image Text 3</label>
                                <input type="text" name="img_text3" id="img_text3" class="form-control"
                                    value="{{ $data->img_text3 }}">
                            </div>
                            <div class="mb-3">
                                <label for="heading3" class="form-label">Heading 3</label>
                                <input type="text" name="heading3" id="heading3" class="form-control"
                                    value="{{ $data->heading3 }}">
                            </div>
                            <div class="mb-3">
                                <label for="section3" class="form-label">Section 3</label>
                                <div id="section3">
                                </div>
                                <input type="hidden" name="section3">
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
        const quill2 = new Quill("#section2", {
            theme: "snow",
        });
        const quill3 = new Quill("#section3", {
            theme: "snow",
        });

        quill1.root.innerHTML = @json($data->section1);
        quill2.root.innerHTML = @json($data->section2);
        quill3.root.innerHTML = @json($data->section3);

        quill1.on('text-change', function(delta, oldDelta, source) {
            $('[name="section1"]').val(quill1.root.innerHTML);
        });
        quill2.on('text-change', function(delta, oldDelta, source) {
            $('[name="section2"]').val(quill2.root.innerHTML);
        });
        quill3.on('text-change', function(delta, oldDelta, source) {
            $('[name="section3"]').val(quill3.root.innerHTML);
        })

        $('#img1').on('change', function(e) {
            showPreview(e, '#img1Preview');
        })

        $('#img2').on('change', function(e) {
            showPreview(e, '#img2Preview');
        })

        $('#img3').on('change', function(e) {
            showPreview(e, '#img3Preview');
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
