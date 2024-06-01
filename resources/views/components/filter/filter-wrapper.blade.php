@props([
    'filters',
    'hasFilters',
    'gridColsMd' => 2,
    'gridColsLg' => 3,
    'gap' => 6,
    'wrapperClass' => '',
    'label' => 'Filters',
])

@php
    $visibleFilters = array_filter($filters, function ($filter) {
        return !$filter->isHidden();
    });

    $gridColsClasses = 'grid-cols-1 ' . 'md:grid-cols-' . $gridColsMd . ' lg:grid-cols-' . $gridColsLg;
@endphp

@if (count($visibleFilters) > 0)
    <div class="bg-white rounded-lg shadow-lg overflow-hidden {{ $wrapperClass }}" x-data="{ showFilters: false }">
        <div class="px-4 py-2 bg-gradient-to-r from-purple-500 to-indigo-500">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-white">{{ $label }}</h3>
                <button @click="showFilters = !showFilters" class="text-white hover:text-gray-200 focus:outline-none">
                    <svg x-show="!showFilters" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                    <svg x-show="showFilters" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                    </svg>
                </button>
            </div>
        </div>
        <div x-show="showFilters" x-collapse class="p-2 md:p-4">
            <div class="mb-4 flex justify-between items-center">
                <button wire:click="clearAllFilters"
                    class="text-purple-600 hover:text-purple-800 focus:outline-none {{ $hasFilters ? '' : 'cursor-not-allowed opacity-50' }}"
                    {{ $hasFilters ? '' : 'disabled' }}>
                    Clear Filters
                </button>
                <span class="text-sm text-gray-600">{{ count($visibleFilters) }} filters available</span>
            </div>
            <div class="grid {{ $gridColsClasses }} {{ $gap ? 'gap-' . $gap : '' }}">
                @foreach ($visibleFilters as $filter)
                    @if (!$filter->isHidden())
                        <div class="bg-gray-100 rounded-md p-4">
                            {{ $filter->render() }}
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endif
