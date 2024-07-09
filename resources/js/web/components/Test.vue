<template>
    <div>
        <h1>{{ title }}</h1>
        <button @click="incrementCount">Count: {{ count }}</button>
    </div>
</template>

<script lang="ts">
import { defineComponent, defineCustomElement } from 'vue';
import { useCounter } from '../composables/useCounter';

export default defineComponent({
    name: 'Test',
    setup() {
        const { title, count, incrementCount } = useCounter('Test Component');

        return {
            title,
            count,
            incrementCount,
        };
    },
});


</script>
