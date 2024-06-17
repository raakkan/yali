<div x-data="{ currentStep: 0, steps: {{ $wizard->getSteps()->map(fn($item) => $item->render()) }} }">
    @foreach ($wizard->getSteps() as $item)
        {{ $item->render() }}
    @endforeach

    <button>Next</button>
</div>
