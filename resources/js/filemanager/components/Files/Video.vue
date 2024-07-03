<template>
    <img v-lazy-load="thumbUrl" loading="lazy" alt="Thumbnail" class="w-full h-full object-cover">
</template>

<script lang="ts">
import { defineComponent, computed } from 'vue';
import { IFile } from '../../types';
import vLazyLoad from '../../directives/lazyLoad';

export default defineComponent({
    name: 'Video',
    directives: {
        'lazy-load': vLazyLoad,
    },
    props: {
        file: {
            type: Object as () => IFile,
            required: true
        },
    },
    setup(props) {
        const thumbUrl = computed(() => {
            if (props.file.thumbnails) {
                return props.file.thumbnails.small_thumb.url;
            }
            return null;
        });

        return { thumbUrl };
    }
});
</script>
