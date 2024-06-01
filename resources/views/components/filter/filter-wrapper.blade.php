@props(['filters', 'hasFilters', 'gridColsMd' => 2, 'gridColsLg' => 3, 'gap' => 6, 'wrapperClass' => ''])

@php
    $visibleFilters = array_filter($filters, function ($filter) {
        return !$filter->isHidden();
    });

    $gridColsClasses = 'grid-cols-1 ' . 'md:grid-cols-' . $gridColsMd . ' lg:grid-cols-' . $gridColsLg;
@endphp

@if (count($visibleFilters) > 0)
    <div class="bg-white dark:bg-gray-800 dark:border-gray-700 {{ $wrapperClass }}" x-data="{ showFilters: false }">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold">Filters</h3>
            <div>
                <button wire:click="clearAllFilters"
                    class="btn btn-xs {{ $hasFilters ? 'btn-primary' : 'btn-ghost cursor-not-allowed' }}" type="button"
                    {{ $hasFilters ? '' : 'disabled' }}>
                    Clear Filters
                </button>
                <button @click="showFilters = !showFilters" class="btn btn-xs btn-ghost ml-2">
                    <span x-show="!showFilters">Show Filters</span>
                    <span x-show="showFilters">Hide Filters</span>
                </button>
            </div>
        </div>
        <div x-show="showFilters" x-collapse class="grid {{ $gridColsClasses }} {{ $gap ? 'gap-' . $gap : '' }}">
            @foreach ($visibleFilters as $filter)
                @if (!$filter->isHidden())
                    <div class="bg-gray-100 dark:bg-gray-900 rounded-md p-4">
                        {{ $filter->render() }}
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endif
