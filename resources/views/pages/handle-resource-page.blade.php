<div class="space-y-4">
    <x-yali::ui.button label="Back" class="btn btn-white" icon="chevron-left"
        link="{{ route($this->getResoureceRoute()) }}" />
    <x-yali::card title="{{ $this->getTitle() }}" description="Handle Resource Page">
        <x-yali::forms.form :fields="$fields" />
    </x-yali::card>
</div>
