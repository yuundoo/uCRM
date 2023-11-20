<script setup>
import { Link } from "@inertiajs/vue3";
import { ref } from "vue";

const newTitle = ref('')
const newContent = ref('')
</script>


<template>
<input type="text" name="newTitle" v-model="newTitle">{{ newTitle }}<br>
<input type="text" name="newContent" v-model="newContent">{{ newContent }}<br>
<Link as="button" method="post" :href="route('inertia.store')" :data="{title : newTitle, content : newContent}">保存リスト</Link>

</template>


