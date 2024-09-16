<div class="modal fade" id="articleStore" tabindex="-1" aria-labelledby="articleStoreLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="articleStoreLabel">Article Details</h5>
                <button class="btn-close" type="button" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('admin.article.store') }}" id="updateDataForm">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" class="updateDataField">
                    <div class="mb-3">
                        <label class="form-label" for="articleCategory">Category</label>
                        <select class="form-select updateDataField" id="articleCategory" name="category"">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    data-topics-route="{{ route('admin.categories.topics', $category->id) }}">
                                    {{ $category->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="title">Title</label>
                        <input class="form-control updateDataField" id="title" type="text" placeholder="Title"
                            name="title">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="content">Content</label>
                        <div id="content">
                        </div>
                        <input class="updateDataField" id="hiddenContent" type="hidden" name="content">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="articleMedia">Media File</label>
                        <input class="form-control updateDataField" id="articleMedia" type="file" name="media_file"
                            accept="image/*">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-coreui-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
