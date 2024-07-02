@props([
    'fieldId',
    'fieldName',
    'formId',
    'bold' => false,
    'italic' => false,
    'link' => false,
    'code' => false,
    'underline' => false,
    'strike' => false,
    'image' => false,
])

@php
    $toolbarShow = $bold || $italic || $link || $code || $underline || $strike || $image;
@endphp

@if ($toolbarShow)
    <div x-data class="bg-gray-50 border-x border-t border-gray-200 rounded-t-lg p-2 flex items-center space-x-2"
        x-ref="toolbar_{{ $fieldId }}">
        @if ($bold)
            <button type="button" x-on:click="toggleBold()" x-bind:class="{ 'bg-gray-200': activeStates.bold }"
                class="p-1.5 rounded text-gray-600 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 transition duration-150 ease-in-out"
                title="Bold">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path
                        d="M8 11H12.5C13.8807 11 15 9.88071 15 8.5C15 7.11929 13.8807 6 12.5 6H8V11ZM18 15.5C18 17.9853 15.9853 20 13.5 20H6V4H12.5C14.9853 4 17 6.01472 17 8.5C17 9.70431 16.5269 10.7981 15.7564 11.6058C17.0979 12.3847 18 13.837 18 15.5ZM8 13V18H13.5C14.8807 18 16 16.8807 16 15.5C16 14.1193 14.8807 13 13.5 13H8Z">
                    </path>
                </svg>
            </button>
        @endif
        @if ($italic)
            <button type="button" x-on:click="toggleItalic()" x-bind:class="{ 'bg-gray-200': activeStates.italic }"
                class="p-1.5 rounded text-gray-600 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 transition duration-150 ease-in-out"
                title="Italic">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M15 20H7V18H9.92661L12.0734 6H9V4H17V6H14.0734L11.9266 18H15V20Z"></path>
                </svg>
            </button>
        @endif
        @if ($link)
            <button type="button" x-on:click="toggleLink()" x-bind:class="{ 'bg-gray-200': activeStates.link }"
                class="p-1.5 rounded text-gray-600 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 transition duration-150 ease-in-out"
                title="Link">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path
                        d="M18.364 15.536L16.95 14.12l1.414-1.414a5 5 0 1 0-7.071-7.071L9.879 7.05 8.464 5.636 9.88 4.222a7 7 0 0 1 9.9 9.9l-1.415 1.414zm-2.828 2.828l-1.415 1.414a7 7 0 0 1-9.9-9.9l1.415-1.414L7.05 9.88l-1.414 1.414a5 5 0 1 0 7.071 7.071l1.414-1.414 1.415 1.414zm-.708-10.607l1.415 1.415-7.071 7.07-1.415-1.414 7.071-7.07z">
                    </path>
                </svg>
            </button>
        @endif
        @if ($code)
            <button type="button" x-on:click="toggleCode()" x-bind:class="{ 'bg-gray-200': activeStates.code }"
                class="p-1.5 rounded text-gray-600 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 transition duration-150 ease-in-out"
                title="Code">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path
                        d="M24 12L18.3431 17.6569L16.9289 16.2426L21.1716 12L16.9289 7.75736L18.3431 6.34315L24 12ZM2.82843 12L7.07107 16.2426L5.65685 17.6569L0 12L5.65685 6.34315L7.07107 7.75736L2.82843 12ZM9.78845 21H7.66009L14.2116 3H16.3399L9.78845 21Z">
                    </path>
                </svg>
            </button>
        @endif
        @if ($underline)
            <button type="button" x-on:click="toggleUnderline()"
                x-bind:class="{ 'bg-gray-200': activeStates.underline }"
                class="p-1.5 rounded text-gray-600 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 transition duration-150 ease-in-out"
                title="Underline">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path
                        d="M8 3V12C8 14.2091 9.79086 16 12 16C14.2091 16 16 14.2091 16 12V3H18V12C18 15.3137 15.3137 18 12 18C8.68629 18 6 15.3137 6 12V3H8ZM4 20H20V22H4V20Z">
                    </path>
                </svg>
            </button>
        @endif
        @if ($strike)
            <button type="button" x-on:click="toggleStrike()" x-bind:class="{ 'bg-gray-200': activeStates.strike }"
                class="p-1.5 rounded text-gray-600 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 transition duration-150 ease-in-out"
                title="Strike">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path
                        d="M17.1538 14C17.3846 14.5161 17.5 15.0893 17.5 15.7196C17.5 17.0625 16.9762 18.1116 15.9286 18.867C14.8809 19.6223 13.4335 20 11.5862 20C9.94674 20 8.32335 19.6185 6.71592 18.8555V16.6009C8.23538 17.4783 9.7908 17.917 11.3822 17.917C13.9333 17.917 15.2128 17.1846 15.2208 15.7196C15.2208 15.0939 15.0049 14.5598 14.5731 14.1173C14.5339 14.0772 14.4939 14.0381 14.4531 14H3V12H21V14H17.1538ZM13.076 11H7.62908C7.4566 10.8433 7.29616 10.6692 7.14776 10.4778C6.71592 9.92084 6.5 9.24559 6.5 8.45207C6.5 7.21602 6.96583 6.165 7.89749 5.299C8.82916 4.43299 10.2706 4 12.2219 4C13.6934 4 15.1009 4.32808 16.4444 4.98426V7.13591C15.2448 6.44921 13.9293 6.10587 12.4978 6.10587C10.0187 6.10587 8.77917 6.88793 8.77917 8.45207C8.77917 8.87172 8.99709 9.23796 9.43293 9.55079C9.86878 9.86362 10.4066 10.1135 11.0463 10.3004C11.6665 10.4816 12.3431 10.7148 13.076 11Z">
                    </path>
                </svg>
            </button>
        @endif
        @if ($image)
            <button type="button"
                x-on:click="$dispatch('open-file-upload-modal', {'fieldName': '{{ $fieldName }}', 'formId': '{{ $formId }}', 'multiple': true, 'accept': 'image'})"
                class="p-1.5 rounded text-gray-600 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 transition duration-150 ease-in-out"
                title="Insert Image">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path
                        d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                </svg>
            </button>
        @endif
    </div>
@endif
