<script setup>
defineProps(['value']);
</script>

<template>
   <label class="block mt-3 ml-5 text-sm font-medium text-gray-700">
      <span v-if="value">{{ value }}</span>
      <span v-else><slot /></span>
   </label>
</template>
