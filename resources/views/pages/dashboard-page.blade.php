<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-4">
    @php
        $widgets = $this->getWidgets();
    @endphp

    @foreach ($widgets as $widget)
        @livewire($widget)
    @endforeach
</div>
