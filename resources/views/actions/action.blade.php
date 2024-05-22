<div>
    @php
        $model = $class->getModel();
        $resource = $class->getResource();
    @endphp


    @if ($class->isLink())
    <a href="{{ $class->getRoute() }}" @else <button @endif
            class="button-primary inline-flex justify-center">

            {{ $class->getLabel() }}

            @if ($class->isLink())
        </a>
    @else
        </button>
    @endif
</div>
