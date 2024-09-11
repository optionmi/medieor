<div class="modal fade" id="permissionModal" tabindex="-1" aria-labelledby="permissionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="permissionModalLabel">
                    Manage Permissions
                </h5>
                <button class="btn-close" type="button" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updateDataForm" action="" method="POST">
                @csrf
                <div class="modal-body d-flex justify-content-center">
                    <div class="d-flex flex-column">
                        @foreach ($admin_permissions as $permission)
                            <div>
                                <input class="mx-1 permissionCheckBox" type="checkbox" name="permissions[]"
                                    value="{{ $permission->id }}" id="permission_{{ $permission->id }}">
                                <label
                                    for="permission_{{ $permission->id }}">{{ ucwords(str_replace('_', ' ', $permission->name)) }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-coreui-dismiss="modal">
                        Close
                    </button>
                    <button class="btn btn-primary" type="submit">
                        Confirm
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
