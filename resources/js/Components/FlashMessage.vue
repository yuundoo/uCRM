<script setup></script>

<template>
    <div
        v-if="$page.props.flash.status === 'success'"
        class="p-4 text-lg font-semibold text-white bg-blue-300 rounded-lg shadow-md"
    >
        {{ $page.props.flash.message }}
    </div>
</template>
