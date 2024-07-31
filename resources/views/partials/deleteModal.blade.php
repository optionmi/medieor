<div data-twe-modal-init
    class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
    id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div data-twe-modal-dialog-ref
        class="pointer-events-none relative w-auto translate-y-[-50px] opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:max-w-[500px]">
        <div
            class="relative flex flex-col w-full text-current bg-white border-none rounded-md outline-none pointer-events-auto bg-clip-padding shadow-4 dark:bg-surface-dark">
            <div
                class="flex items-center justify-between flex-shrink-0 p-4 border-b-2 rounded-t-md border-neutral-100 dark:border-white/10">
                <h5 class="text-xl font-medium leading-normal text-surface dark:text-white" id="deleteModalLabel">
                    Are you sure you want to delete?
                </h5>
                <button type="button"
                    class="box-content border-none rounded-none text-neutral-500 hover:text-neutral-800 hover:no-underline focus:text-neutral-800 focus:opacity-100 focus:shadow-none focus:outline-none dark:text-neutral-400 dark:hover:text-neutral-300 dark:focus:text-neutral-300"
                    data-twe-modal-dismiss aria-label="Close">
                    <span class="[&>svg]:h-6 [&>svg]:w-6">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </span>
                </button>
            </div>

            <!-- Modal body -->
            <div class="relative flex-auto p-4" data-twe-modal-body-ref>
                <div class="flex flex-col">
                    <svg class="text-red-600">
                        <use xlink:href="{{ asset('coreui/vendors/@coreui/icons/svg/free.svg#cil-trash') }}"></use>
                    </svg>
                    <p class="my-5 text-2xl text-center text-red-600">
                        You won't be able to revert this!
                    </p>
                </div>
            </div>

            <!-- Modal footer -->
            <div
                class="flex flex-wrap items-center justify-end flex-shrink-0 p-4 border-t-2 rounded-b-md border-neutral-100 dark:border-white/10">
                <button type="button"
                    class="inline-block rounded bg-primary-100 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-primary-700 transition duration-150 ease-in-out hover:bg-primary-accent-200 focus:bg-primary-accent-200 focus:outline-none focus:ring-0 active:bg-primary-accent-200 dark:bg-primary-300 dark:hover:bg-primary-400 dark:focus:bg-primary-400 dark:active:bg-primary-400"
                    data-twe-modal-dismiss data-twe-ripple-init data-twe-ripple-color="light">
                    Close
                </button>
                <button type="button"
                    class="ms-1 inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong"
                    data-twe-modal-dismiss data-twe-ripple-init data-twe-ripple-color="light" id="confirmDeleteBtn">
                    Confirm
                </button>
            </div>
        </div>
    </div>
</div>
