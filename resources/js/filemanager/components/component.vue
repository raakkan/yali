<template>
  <Menu>
    <MenuButton class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-300">
      Options
    </MenuButton>
    <MenuItems class="mt-2 bg-white shadow-lg rounded-md py-2 w-56">
      <MenuItem v-slot="{ active }">
        <a :class='["block px-4 py-2 text-sm transition-colors duration-150 ease-in-out", active ? "bg-green-100 text-green-900" : "text-gray-700"]' href="/account-settings">
          Account settings
        </a>
      </MenuItem>
      <MenuItem v-slot="{ active }">
        <a :class='["block px-4 py-2 text-sm transition-colors duration-150 ease-in-out", active ? "bg-green-100 text-green-900" : "text-gray-700"]' href="/documentation">
          Documentation
        </a>
      </MenuItem>
      <MenuItem disabled>
        <span class="block px-4 py-2 text-sm text-gray-400 cursor-not-allowed">
          Invite a friend (coming soon!)
        </span>
      </MenuItem>
    </MenuItems>
  </Menu>
</template>


<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({
  name: 'FileManagerComponent',
  setup() {
    // Your composition logic here if any

    // Return an object containing properties and methods to be used in the template
    return {};
  },
});
</script>

<style scoped>
/* Your component styles */
</style>
