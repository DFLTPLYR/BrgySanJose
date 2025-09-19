<template>
  <button
    class="flex h-12 w-full items-center justify-center rounded-md border bg-white shadow hover:bg-gray-50"
  >
    <Icon :icon="icon" class="h-6 w-6" />
  </button>
</template>

<script setup>
import { Icon } from "@iconify/vue";

defineProps({
  provider: String,
  icon: String,
});
</script>

