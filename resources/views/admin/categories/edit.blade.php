<div class="modal fade" id="categoryUpdate" tabindex="-1" aria-labelledby="categoryUpdateLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="categoryUpdateLabel">Edit Category</h5>
                <button class="btn-close" type="button" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="" id="updateDataForm">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label" for="title">Title</label>
                        <input class="form-control updateDataField" id="title" type="text" placeholder="Title"
                            name="title">
                    </div>
                    {{-- <div class="mb-3">
                        <label class="form-label" for="description">Description</label>
                        <textarea class="form-control updateDataField" id="description" rows="3" name="description"></textarea>
                    </div> --}}
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <div id="description">
                        </div>
                        <input class="updateDataField" id="hiddenDescription" type="hidden" name="description">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="logo">Logo</label>
                        <input class="form-control" id="logo" type="file" name="logo" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="banner">Banner</label>
                        <input class="form-control" id="banner" type="file" name="image" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label for="imgText" class="form-label">Banner Text</label>
                        <div id="imgText">
                        </div>
                        <input class="updateDataField" id="hiddenImgText" type="hidden" name="img_text">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-coreui-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
