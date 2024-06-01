import 'flowbite';

// import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';
// import collapse from '@alpinejs/collapse'

// Alpine.plugin(collapse)

Livewire.directive('yali-confirm', async ({ el, directive, component, cleanup }) => {
    console.log(directive.expression, el);
    let content = eval(`(${directive.expression})`);
    let wireClickFunction = el.getAttribute('wire:click').replace(/\([^)]+\)/g, "");

    let onClick = e => {
        e.preventDefault();
        e.stopImmediatePropagation();

        // Dispatch a custom event to open the confirmation modal
        window.dispatchEvent(new CustomEvent('confirm-open', {
            detail: {
                id: component.id,
                title: content.title,
                message: content.message,
                payload: content.payload,
            }
        }));

        // Wait for the user's response
        const confirmListener = event => {
            if (event.detail.id === component.id) {
                if (event.type === 'confirm-confirmed') {
                    // console.log(Livewire.find(component.id).delete(3));
                    // User clicked "Yes, I'm sure"
                    if (content.payload && event.detail.payload === content.payload) {
                        Livewire.find(component.id).call(wireClickFunction, content.payload)
                    } else {
                        Livewire.find(component.id).call(wireClickFunction)
                    }
                } else if (event.type === 'confirm-cancelled') {
                    // User clicked "Cancel"
                    // Do nothing, the action is cancelled
                    console.log('Cancelled');
                }
                window.removeEventListener('confirm-confirmed', confirmListener);
                window.removeEventListener('confirm-cancelled', confirmListener);
            }
        };

        window.addEventListener('confirm-confirmed', confirmListener);
        window.addEventListener('confirm-cancelled', confirmListener);
    };

    el.addEventListener('click', onClick, { capture: true });

    cleanup(() => {
        el.removeEventListener('click', onClick);
    });
});
