<div class="modal fade" id="demotionModal" tabindex="-1" aria-labelledby="demotionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="demotionModalLabel">
                    Are you sure?
                </h5>
                <button class="btn-close" type="button" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST">
                <div class="modal-body d-flex justify-content-center">
                    <div class="d-flex flex-column">
                        <svg class="text-danger">
                            <use xlink:href="{{ asset('coreui/vendors/@coreui/icons/svg/free.svg#cil-trash') }}"></use>
                        </svg>
                        <p class="my-2 text-center fs-3 text-danger">
                            You are demoting this Admin to User!
                        </p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-coreui-dismiss="modal">
                        Close
                    </button>
                    <button class="btn btn-primary" type="button" data-coreui-dismiss="modal" id="confirmDemoteBtn">
                        Confirm
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
