<div class="modal fade" id="groupStore" tabindex="-1" aria-labelledby="groupStoreLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="groupStoreLabel">Group Details</h5>
                <button class="btn-close" type="button" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('admin.group.store') }}" id="updateDataForm">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" class="updateDataField">
                    <div class="mb-3">
                        <label class="form-label" for="title">Title</label>
                        <input class="form-control updateDataField" id="title" type="text" placeholder="Title"
                            name="title">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="description">Description</label>
                        <textarea class="form-control updateDataField" id="description" rows="3" name="description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="category">Category</label>
                        <select class="form-select updateDataField" id="category" name="category">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="status">Status</label>
                        <select class="form-select updateDataField" id="status" name="status">
                            <option value="1" selected>Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="image">Image</label>
                        <input class="form-control" id="image" type="file" name="image" accept="image/*">
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
