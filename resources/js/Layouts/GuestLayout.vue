<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div
        class="flex flex-col items-center bg-gray-100 sm:justify-center"
        :style="{
            backgroundImage: 'url(/images/register.jpg)',
            backgroundPosition: 'center center',
            backgroundSize: 'cover',
        }"
    >
        <div class="mt-4">
            <Link>
                <ApplicationLogo class="w-20 h-20 text-gray-500 fill-current" />
            </Link>
        </div>

        <div class="w-full sm:max-w-lg sm:rounded-lg">
            <slot />
        </div>
    </div>
</template>
