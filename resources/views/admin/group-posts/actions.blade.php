<div class="d-flex">
    @if (!$post->author->hasRole('admin'))
        @if ($post->author->isMuted)
            <button class="px-2 py-2 btn btn-link nav-link d-flex align-items-center" type="button" title="Unmute"
                data-btn-route="{{ route('admin.user.unmute', $post->author->id) }}">
                <svg class="icon icon-lg text-success">
                    <use xlink:href="{{ url('coreui/vendors/@coreui/icons/svg/free.svg#cil-volume-high') }}">
                    </use>
                </svg>
            </button>
        @else
            <button class="px-2 py-2 btn btn-link nav-link d-flex align-items-center" type="button" title="Mute"
                data-btn-route="{{ route('admin.user.mute', $post->author->id) }}">
                <svg class="icon icon-lg text-danger">
                    <use xlink:href="{{ url('coreui/vendors/@coreui/icons/svg/free.svg#cil-volume-off') }}">
                    </use>
                </svg>
            </button>
        @endif
    @endif
    <button class="px-2 py-2 btn btn-link nav-link d-flex align-items-center" type="button" title="Delete"
        data-coreui-toggle="modal" data-coreui-target="#deleteModal"
        data-delete-route="{{ route('admin.group.post.destroy', $post->id) }}"> <svg class="icon icon-lg text-danger">
            <use xlink:href="{{ url('coreui/vendors/@coreui/icons/svg/free.svg#cil-trash') }}">
            </use>
        </svg>
    </button>
</div>
