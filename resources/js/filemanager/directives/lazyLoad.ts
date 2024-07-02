import { DirectiveBinding } from 'vue';

interface ObserverInstance {
    instance: IntersectionObserver | null;
    entry: IntersectionObserverEntry | null;
}

const observers: Map<Element, ObserverInstance> = new Map();

function loadImage(el: Element, binding: DirectiveBinding) {
    const observer: ObserverInstance = {
        instance: null,
        entry: null,
    };

    const options = {
        rootMargin: binding.value || '0px',
        threshold: 0.1,
    };

    observer.instance = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                const img = entry.target as HTMLImageElement;
                img.src = binding.value as string;
                observer.instance?.unobserve(img);
            }
        });
    }, options);

    observer.instance.observe(el);
    observers.set(el, observer);
}

export const vLazyLoad = {
    mounted(el: Element, binding: DirectiveBinding) {
        loadImage(el, binding);
    },
    updated(el: Element, binding: DirectiveBinding) {
        loadImage(el, binding);
    },
};
