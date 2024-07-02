<div class="modal fade" id="eventStore" tabindex="-1" aria-labelledby="eventStoreLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="eventStoreLabel">Event Details</h5>
                <button class="btn-close" type="button" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('admin.event.store') }}" id="updateDataForm">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" class="updateDataField">
                    <div class="mb-3">
                        <label class="form-label" for="title">Title</label>
                        <input class="form-control updateDataField" id="title" type="text" placeholder="Title"
                            name="title">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="eventCategory">Category</label>
                        <select class="form-select updateDataField" id="eventCategory" name="category"">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    data-topics-route="{{ route('admin.category.topics', $category->id) }}">
                                    {{ $category->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="eventVideo">Video</label>
                        <input class="form-control updateDataField" id="eventVideo" type="file" name="video"
                            accept="video/mp4">
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
