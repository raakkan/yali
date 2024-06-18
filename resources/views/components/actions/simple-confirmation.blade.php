@props([
    'confirmationTitle' => 'Are you sure?',
    'confirmationMessage' => 'Are you sure you want to perform this action?',
    'confirmButton',
])

<div class="bg-white rounded-lg p-4 w-full max-w-md m-4">
    <div>
        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
            <x-yali::icon name="exclamation" class="h-6 w-6 text-red-600" />
        </div>
        <div class="mt-3 text-center sm:mt-5">
            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                {{ $confirmationTitle }}
            </h3>
            <div class="mt-2">
                <p class="text-sm text-gray-500">
                    {{ $confirmationMessage }}
                </p>
            </div>
        </div>
    </div>
    <div class="mt-5 sm:mt-6 sm:grid sm:grid-cols-2 sm:gap-3 sm:grid-flow-row-dense">
        <span class="flex w-full rounded-md shadow-sm sm:col-start-2">
            @if (isset($confirmButton))
                {{ $confirmButton }}
            @endif
        </span>
        <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:col-start-1">
            <x-yali::ui.button label="Cancel" wire:click="cancelAction" class="btn btn-ghost btn-full-width btn-sm" />
        </span>
    </div>
</div>
