@props(['filters', 'hasFilters', 'wrapperClass' => '', 'label' => 'Filters'])

@php
    $visibleFilters = array_filter($filters, function ($filter) {
        return !$filter->isHidden();
    });
@endphp

@if (count($visibleFilters) > 0)
    <div class="bg-white border border-gray-200 rounded-lg" x-data="{ showFilters: false }">
        <div class="px-4 py-2 {{ $hasFilters ? 'bg-gray-100' : 'bg-gray-100' }}  flex items-center justify-between">
            <h3 class="text-lg font-medium text-gray-900">{{ $label }}</h3>
            <button @click="showFilters = !showFilters" class="text-blue-500 hover:text-blue-600 focus:outline-none">
                <svg x-show="!showFilters" class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
                <svg x-show="showFilters" class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"
                        clip-rule="evenodd" />
                </svg>
            </button>
        </div>
        <div x-show="showFilters" x-collapse class="p-4">
            <div class="mb-4 flex justify-between items-center">
                <button wire:click="clearAllFilters"
                    class="text-red-500 hover:text-red-600 focus:outline-none {{ $hasFilters ? '' : 'cursor-not-allowed opacity-50' }}"
                    {{ $hasFilters ? '' : 'disabled' }}>
                    Clear Filters
                </button>
                <span class="text-sm text-gray-600">{{ count($visibleFilters) }} filters available</span>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($visibleFilters as $filter)
                    @if (!$filter->isHidden())
                        <div class="bg-gray-50 border border-gray-200 rounded-md p-4">
                            {{ $filter->render() }}
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endif
