<div class="space-y-4">
    <x-yali::ui.button label="Back" class="btn btn-white" icon="chevron-left"
        link="{{ route($this->getResoureceRoute()) }}" />
    <x-yali::card title="{{ $this->getTitle() }}" description="Handle Resource Page">
        <div class="p-4">
            <x-yali::forms.form :fields="$fields" />
        </div>
    </x-yali::card>
</div>
