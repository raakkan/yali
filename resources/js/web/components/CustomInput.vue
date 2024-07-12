<template>
    <div>
        <label v-if="label" :for="id">{{ label }}</label>
        <input :id="id" :type="type" :value="value" @input="handleInput" :placeholder="placeholder"
            :disabled="disabled" />
    </div>
</template>

<script lang="ts">
import { defineComponent, defineCustomElement } from 'vue';

export default defineComponent({
    name: 'CustomInput',
    props: {
        value: {
            type: String,
            required: true,
        },
        label: {
            type: String,
            default: '',
        },
        type: {
            type: String,
            default: 'text',
        },
        placeholder: {
            type: String,
            default: '',
        },
        disabled: {
            type: Boolean,
            default: false,
        },
    },
    emits: ['input'],
    setup(props, { emit }) {
        const id = `input-${Math.random().toString(36).substring(2, 9)}`;

        const handleInput = (event: Event) => {


            const inputElement = event.target as HTMLInputElement;
            console.log(inputElement.value);
            emit('input', inputElement.value);
        };

        return {
            id,
            handleInput,
        };
    },
});
</script>