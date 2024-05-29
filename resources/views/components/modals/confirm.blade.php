<div x-data="{ id: '', open: false, title: '', message: '', payload: '' }"
    x-on:confirm-open.window="open = true; id = $event.detail.id; title = $event.detail.title; message = $event.detail.message; payload = $event.detail.payload"
    x-show="open" x-cloak>

    <x-yali::modals.modal :headerAndFooter="false">
        <div class="flex items-center justify-center">
            <div class="bg-white rounded-lg p-4 w-full max-w-md m-4">
                <div>
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                        <x-yali::icon name="exclamation" class="h-6 w-6 text-red-600" />
                    </div>
                    <div class="mt-3 text-center sm:mt-5">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline" x-text="title">
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500" x-text="message">
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mt-5 sm:mt-6 sm:grid sm:grid-cols-2 sm:gap-3 sm:grid-flow-row-dense">
                    <span class="flex w-full rounded-md shadow-sm sm:col-start-2">
                        <button type="button"
                            x-on:click="$dispatch('confirm-confirmed', { id: id, payload: payload }); open = false"
                            class="btn btn-danger btn-full-width btn-sm">
                            Yes, I'm sure
                        </button>
                    </span>
                    <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:col-start-1">
                        <button type="button" class="btn btn-ghost btn-full-width btn-sm"
                            x-on:click="$dispatch('confirm-cancelled', { id: id, payload: payload }); open = false">
                            Cancel
                        </button>
                    </span>
                </div>
            </div>
        </div>
    </x-yali::modals.modal>
</div>
