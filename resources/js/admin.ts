import './vue/vue-mounter';

import { defineComponent, defineCustomElement } from 'vue';

import Test from './web/components/Test.vue';
import CustomInput from './web/components/CustomInput.vue';

// Register the component as a web component
const TestElement = defineCustomElement(Test);

// Expose the web component
customElements.define('test-component', TestElement);

const CustomInputWebComponent = defineCustomElement(CustomInput);

customElements.define('custom-input', CustomInputWebComponent);