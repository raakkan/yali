Livewire.directive('yali-modal', async ({ el, directive, component, cleanup }) => {
    let content = eval(`(${directive.expression})`);
    let livewireComponent = Livewire.find(component.id);

    const handleClick = () => {
        console.log(content);
        // Call the Livewire method
        // livewireComponent.call('getTableActionByKey', content.action)
        //     .then(action => {
        //         // console.log(action, content);
        //     })
        //     .catch(error => {
        //         console.error('Error calling Livewire method:', error);
        //     });
    };

    el.addEventListener('click', handleClick, { capture: true });

    // Cleanup function to remove the event listener
    cleanup(() => {
        el.removeEventListener('click', handleClick);
    });
});
