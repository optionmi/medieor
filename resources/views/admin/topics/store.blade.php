<div class="modal fade" id="topicStore" tabindex="-1" aria-labelledby="topicStoreLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="topicStoreLabel">Topic Details</h5>
                <button class="btn-close" type="button" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('admin.topics.store') }}" id="updateDataForm">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" class="updateDataField">
                    <div class="mb-3">
                        <label class="form-label" for="name">Name</label>
                        <input class="form-control updateDataField" id="name" type="text"
                            placeholder="Topic Name" name="name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="category">Category</label>
                        <select class="form-select updateDataField" id="category" name="category">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
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
