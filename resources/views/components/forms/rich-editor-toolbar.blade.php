<div class="bg-gray-50 border border-gray-200 rounded-t-lg p-2 flex items-center space-x-2"
    x-ref="toolbar_{{ $fieldId }}">
    <button type="button" x-on:click="toggleBold()"
        class="p-1.5 rounded text-gray-600 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 transition duration-150 ease-in-out"
        title="Bold">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
            class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M6.75 7.5l3 2.25-3 2.25m4.5 0h3m-9 8.25h13.5A2.25 2.25 0 0021 18V6a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 6v12a2.25 2.25 0 002.25 2.25z" />
        </svg>
    </button>
</div>
