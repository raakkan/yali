import 'flowbite';

// import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';
// import Clipboard from '@ryangjchandler/alpine-clipboard'

// Alpine.plugin(Clipboard)

// Livewire.start()


// document.addEventListener('livewire:initialized', () => {

// })

Livewire.directive('yali-confirm', ({ el, directive, component, cleanup }) => {
    let content = eval(`(${directive.expression})`);
    console.log(content.id);
    let onClick = e => {
        e.preventDefault();
        e.stopImmediatePropagation();

        // Dispatch a custom event to open the confirmation modal
        window.dispatchEvent(new CustomEvent('confirm-open', {
            detail: {
                message: content,
                id: component.id
            }
        }));

        // Wait for the user's response
        const confirmListener = event => {
            if (event.detail.id === component.id) {
                if (event.type === 'confirm-confirmed') {
                    // User clicked "Yes, I'm sure"
                    el.removeEventListener('click', onClick);
                    el.click();
                } else if (event.type === 'confirm-cancelled') {
                    // User clicked "Cancel"
                    // Do nothing, the action is cancelled
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


// <div x-data="{ open: false, message: '', id: '' }"
//      x-on:confirm-open.window="open = true; message = $event.detail.message; id = $event.detail.id"
//      x-show="open"
//      x-cloak>
//     <!-- Modal content -->
//     <div>
//         <h3 x-text="message"></h3>
//         <button x-on:click="$dispatch('confirm-confirmed', { id: id }); open = false">
//             Yes, I'm sure
//         </button>
//         <button x-on:click="$dispatch('confirm-cancelled', { id: id }); open = false">
//             Cancel
//         </button>
//     </div>
// </div>
