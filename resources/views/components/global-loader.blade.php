<script>
    document.addEventListener('livewire:init', () => {

        Livewire.hook('request', ({
            uri,
            options,
            payload,
            respond,
            succeed,
            fail
        }) => {
            window.dispatchEvent(
                new CustomEvent('loading', {
                    detail: {
                        loading: true
                    }
                })
            );

            respond(({
                status,
                response
            }) => {
                window.dispatchEvent(
                    new CustomEvent('loading', {
                        detail: {
                            loading: false
                        }
                    })
                );
            })

            succeed(({
                status,
                json
            }) => {
                window.dispatchEvent(
                    new CustomEvent('loading', {
                        detail: {
                            loading: false
                        }
                    })
                );
            })

            fail(({
                status,
                content,
                preventDefault
            }) => {
                window.dispatchEvent(
                    new CustomEvent('loading', {
                        detail: {
                            loading: false
                        }
                    })
                );
            })
        })
    })
</script>

<div x-data="{ loading: false }" x-show="loading" @loading.window="loading = $event.detail.loading" class="header-loading">
</div>
