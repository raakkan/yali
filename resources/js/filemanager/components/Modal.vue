<template>
    <div v-if="isVisible"
        class="fixed inset-0 z-50 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full flex items-center justify-center">
        <div class="bg-white rounded-lg p-4 w-full max-w-md m-4">
            <div>
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full"
                    :class="iconBackgroundClass">
                    <slot name="icon"></slot>
                </div>
                <div class="mt-3 text-center sm:mt-5">
                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                        <slot name="title"></slot>
                    </h3>
                    <div class="mt-2">
                        <slot name="content"></slot>
                    </div>
                </div>
            </div>
            <div class="mt-5 sm:mt-6 sm:grid sm:grid-cols-2 sm:gap-3 sm:grid-flow-row-dense">
                <span class="flex w-full rounded-md shadow-sm sm:col-start-2">
                    <slot name="confirm-button"></slot>
                </span>
                <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:col-start-1">
                    <slot name="cancel-button"></slot>
                </span>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({
    name: 'Modal',
    props: {
        isVisible: {
            type: Boolean,
            required: true,
        },
        iconBackgroundClass: {
            type: String,
            default: 'bg-blue-100',
        },
    },
});
</script>