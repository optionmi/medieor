<div class="modal fade" id="categoryPostStore" tabindex="-1" aria-labelledby="categoryPostStoreLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="categoryPostStoreLabel">Post Details</h5>
                <button class="btn-close" type="button" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('admin.category.post.store') }}" id="updateDataForm">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" class="updateDataField">
                    <div class="mb-3">
                        <label class="form-label" for="title">Title</label>
                        <input class="form-control updateDataField" id="title" type="text" placeholder="Title"
                            name="title">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="body">Body</label>
                        <div id="body">
                        </div>
                        <input class="updateDataField" id="hiddenBody" type="hidden" name="body">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="categoryPostCategory">Category</label>
                        <select class="form-select updateDataField" id="categoryPostCategory" name="category"">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    data-topics-route="{{ route('admin.category.topics', $category->id) }}">
                                    {{ $category->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="categoryPostTopic">Topic</label>
                        <select class="form-select updateDataField selectOptions" id="categoryPostTopic" name="topic">
                            @foreach ($topics as $topic)
                                <option value="{{ $topic->id }}">{{ $topic->name }}</option>
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
