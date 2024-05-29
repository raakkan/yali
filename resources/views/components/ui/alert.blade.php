@props(['type' => 'info', 'message'])

@php
    $alertClasses = [
        'info' => 'bg-blue-100 text-blue-700',
        'success' => 'bg-green-100 text-green-700',
        'warning' => 'bg-yellow-100 text-yellow-700',
        'error' => 'bg-red-100 text-red-700',
    ];

    $iconClasses = [
        'info' => 'text-blue-500',
        'success' => 'text-green-500',
        'warning' => 'text-yellow-500',
        'error' => 'text-red-500',
    ];
@endphp

<div {{ $attributes->merge(['class' => 'p-4 text-sm rounded-lg ' . ($alertClasses[$type] ?? $alertClasses['info'])]) }}
    role="alert">
    <div class="flex items-center">
        @if ($type === 'info')
            <svg class="w-5 h-5 mr-2 {{ $iconClasses['info'] }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                fill="currentColor">
                <path fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                    clip-rule="evenodd" />
            </svg>
        @elseif ($type === 'success')
            <svg class="w-5 h-5 mr-2 {{ $iconClasses['success'] }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                fill="currentColor">
                <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                    clip-rule="evenodd" />
            </svg>
        @elseif ($type === 'warning')
            <svg class="w-5 h-5 mr-2 {{ $iconClasses['warning'] }}" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                    clip-rule="evenodd" />
            </svg>
        @elseif ($type === 'error')
            <svg class="w-5 h-5 mr-2 {{ $iconClasses['error'] }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                fill="currentColor">
                <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                    clip-rule="evenodd" />
            </svg>
        @endif

        <span>{{ $message }}</span>
    </div>
</div>
