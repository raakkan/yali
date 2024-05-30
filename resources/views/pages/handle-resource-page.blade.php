@php
    $submitButton = $this->getForm()->getSubmitButton();

    $subtitle = $this->getResource()->getSubTitle();

    if ($isEditing) {
        $title = $this->getResource()->getUpdatePageTitle();

        $alertMessage = $this->getResource()->getUpdatePageMessage();
        $alertType = $this->getResource()->getUpdatePageMessageType();

        $submitButton->setLabel($this->getResource()->getUpdateSubmitButtonLabel());
    } else {
        $title = $this->getResource()->getCreatePageTitle();

        $alertMessage = $this->getResource()->getCreatePageMessage();
        $alertType = $this->getResource()->getCreatePageMessageType();

        $submitButton->setLabel($this->getResource()->getCreateSubmitButtonLabel());
    }

@endphp

<div class="space-y-4">
    <x-yali::ui.button label="Back" class="btn btn-white" icon="chevron-left"
        link="{{ route($this->getResoureceRoute()) }}" />
    <x-yali::card title="{{ $title }}" subtitle="{{ $subtitle }}">
        @if (isset($alertMessage) && isset($alertType) && $alertMessage && $alertType)
            <div class="p-4">
                <x-yali::ui.alert type="{{ $alertType }}" message="{{ $alertMessage }}" />
            </div>
        @endif
        {{ $this->getForm()->setSubmitButton($submitButton)->render() }}
    </x-yali::card>
</div>
