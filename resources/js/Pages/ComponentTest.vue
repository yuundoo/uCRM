<script setup>
import GeustLayout from '@/Layouts/GuestLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';

const emiTest = (e) => console.log(e);
</script>

<template>
  <GeustLayout>
    <InputLabel value="件名">タイトル</InputLabel>
    <TextInput modelValue="haha" @update:modelValue="emiTest"></TextInput>
  </GeustLayout>
</template>
