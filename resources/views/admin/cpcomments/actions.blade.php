<div class="d-flex">
    @if ($cpcomment->author->isMuted)
        <button class="px-2 py-2 btn btn-link nav-link d-flex align-items-center" type="button" title="Unmute"
            data-btn-route="{{ route('admin.user.unmute', $cpcomment->author->id) }}">
            <svg class="icon icon-lg text-success">
                <use xlink:href="{{ url('coreui/vendors/@coreui/icons/svg/free.svg#cil-volume-high') }}">
                </use>
            </svg>
        </button>
    @else
        <button class="px-2 py-2 btn btn-link nav-link d-flex align-items-center" type="button" title="Mute"
            data-btn-route="{{ route('admin.user.mute', $cpcomment->author->id) }}">
            <svg class="icon icon-lg text-danger">
                <use xlink:href="{{ url('coreui/vendors/@coreui/icons/svg/free.svg#cil-volume-off') }}">
                </use>
            </svg>
        </button>
    @endif
    <button class="px-2 py-2 btn btn-link nav-link d-flex align-items-center" type="button" title="Delete"
        data-coreui-toggle="modal" data-coreui-target="#deleteModal"
        data-delete-route="{{ route('web.category.post.comment.delete', $cpcomment->id) }}"> <svg
            class="icon icon-lg text-danger">
            <use xlink:href="{{ url('coreui/vendors/@coreui/icons/svg/free.svg#cil-trash') }}">
            </use>
        </svg>
    </button>
</div>
