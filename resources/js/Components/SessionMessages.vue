<script setup>
defineProps({
  statusMessage: String,
});
</script>
<template>
  <div v-if="statusMessage" class="mb-4 font-medium text-sm text-green-500">
    {{ statusMessage }}
  </div>
</template>
