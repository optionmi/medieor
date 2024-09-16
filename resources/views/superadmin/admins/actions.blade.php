{{-- @if (!$user->hasRole('admin'))
    <div class="d-flex">
        @if ($user->isMuted)
            <button class="px-2 py-2 btn btn-link nav-link d-flex align-items-center" type="button" title="Unmute"
                data-btn-route="{{ route('admin.user.unmute', $user->id) }}">
                <svg class="icon icon-lg text-success">
                    <use xlink:href="{{ url('coreui/vendors/@coreui/icons/svg/free.svg#cil-volume-high') }}">
                    </use>
                </svg>
            </button>
        @else
            <button class="px-2 py-2 btn btn-link nav-link d-flex align-items-center" type="button" title="Mute"
                data-btn-route="{{ route('admin.user.mute', $user->id) }}">
                <svg class="icon icon-lg text-danger">
                    <use xlink:href="{{ url('coreui/vendors/@coreui/icons/svg/free.svg#cil-volume-off') }}">
                    </use>
                </svg>
            </button>
        @endif
        <button class="px-2 py-2 btn btn-link nav-link d-flex align-items-center" type="button" title="Reset Password"
            data-btn-route="{{ route('admin.users.reset.password', $user->id) }}">
            <svg class="icon icon-lg text-danger">
                <use xlink:href="{{ url('coreui/vendors/@coreui/icons/svg/free.svg#cil-loop-circular') }}">
                </use>
            </svg>
        </button>
        <button class="px-2 py-2 btn btn-link nav-link d-flex align-items-center" type="button" title="Delete"
            data-coreui-toggle="modal" data-coreui-target="#demotionModal"
            data-delete-route="{{ route('admin.users.destroy', $user->id) }}">
            <svg class="icon icon-lg text-danger">
                <use xlink:href="{{ url('coreui/vendors/@coreui/icons/svg/free.svg#cil-trash') }}">
                </use>
            </svg>
        </button>
    </div>
@endif --}}
<div class="d-flex">

    <button class="px-2 py-2 btn btn-link nav-link d-flex align-items-center" type="button" title="Make Superadmin"
        data-btn-route="{{ route('superadmin.admin.make.superadmin', $user->id) }}">
        <svg class="icon icon-lg text-success">
            <use xlink:href="{{ url('coreui/vendors/@coreui/icons/svg/free.svg#cil-user') }}">
            </use>
        </svg>
    </button>
    <button class="px-2 py-2 btn btn-link nav-link d-flex align-items-center" type="button" title="Manage Permissions"
        data-coreui-toggle="modal" data-coreui-target="#permissionModal"
        data-restricted-permissions="{{ json_encode($user->restrictions->pluck('id')->toArray()) }}"
        data-update-route="{{ route('superadmin.user.make.admin', $user->id) }}">
        <svg class="icon icon-lg text-primary">
            <use xlink:href="{{ url('coreui/vendors/@coreui/icons/svg/free.svg#cil-pencil') }}">
            </use>
        </svg>
    </button>

    <button class="px-2 py-2 btn btn-link nav-link d-flex align-items-center" type="button" title="Remove as Admin"
        data-coreui-toggle="modal" data-coreui-target="#demotionModal"
        data-delete-route="{{ route('superadmin.admin.remove.admin', $user->id) }}">
        <svg class="icon icon-lg text-danger">
            <use xlink:href="{{ url('coreui/vendors/@coreui/icons/svg/free.svg#cil-trash') }}">
            </use>
        </svg>
    </button>
</div>
