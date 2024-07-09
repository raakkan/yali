import { ref } from 'vue';

export function useCounter(initialTitle: string) {
    const title = ref(initialTitle);
    const count = ref(0);

    const incrementCount = () => {
        count.value++;
    };

    return {
        title,
        count,
        incrementCount,
    };
}
