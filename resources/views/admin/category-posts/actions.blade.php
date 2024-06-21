<div class="d-flex">
    <button class="px-2 py-2 btn btn-link nav-link d-flex align-items-center edit-btn" type="button" title="Edit"
        data-coreui-toggle="modal" data-coreui-target="#categoryPostStore"
        data-update-route="{{ route('admin.category.post.store') }}"
        data-row-data="{{ json_encode([$category_post->id, $category_post->title, $category_post->body, $category_post->category_id, $category_post->topic_id]) }}"
        data-select-options="{{ json_encode([$category_post->category->topics]) }}">
        <svg class="icon icon-lg text-primary">
            <use xlink:href="{{ url('coreui/vendors/@coreui/icons/svg/free.svg#cil-pencil') }}">
            </use>
        </svg>
    </button>
    <button class="px-2 py-2 btn btn-link nav-link d-flex align-items-center" type="button" title="Delete"
        data-coreui-toggle="modal" data-coreui-target="#deleteModal"
        data-delete-route="{{ route('admin.category.post.destroy', $category_post->id) }}">
        <svg class="icon icon-lg text-danger">
            <use xlink:href="{{ url('coreui/vendors/@coreui/icons/svg/free.svg#cil-trash') }}">
            </use>
        </svg>
    </button>
</div>
