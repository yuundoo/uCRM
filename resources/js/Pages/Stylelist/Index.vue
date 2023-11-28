<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { Link } from "@inertiajs/inertia-vue3";
const props = defineProps({ stylelists: Array });
</script>

<template>
    <Head title="デザイナーご紹介" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                デザイナーご紹介
            </h2>
        </template>
        <div class="container px-4 py-4 mx-auto mt-3">
            <button class="flex p-2">登録</button>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                <div
                    class="p-4 overflow-hidden bg-white rounded-lg shadow-lg"
                    v-for="stylelist in props.stylelists"
                    :key="stylelist.id"
                >
                    <img
                        :src="stylelist.profile_image"
                        alt="Profile image"
                        class="object-contain h-48 w-30"
                    />
                    <div class="p-4">
                        <Link
                            class="mb-2 text-xl font-bold cursor-pointer"
                            :href="
                                route('stylelists.show', {
                                    stylelist: stylelist.id,
                                })
                            "
                        >
                            {{ stylelist.name }}
                        </Link>
                        <p class="mb-4 text-gray-700">
                            {{ stylelist.description }}
                        </p>
                        <div class="mt-2">
                            <!-- Tag list -->
                            <template v-if="stylelist.tags">
                                <span
                                    class="inline-block px-2 mr-1 text-xs text-blue-800 bg-blue-100 rounded-full"
                                    v-for="tag in stylelist.tags"
                                    :key="tag"
                                >
                                    {{ tag }}
                                </span>
                            </template>
                        </div>
                        <div class="flex items-center mb-4">
                            <div class="flex gap-1 text-sm">
                                <!-- Simple star rating, 5 stars maximum -->
                                <template v-for="i in 5" :key="i">
                                    <svg
                                        v-if="i <= stylelist.average_rating"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                        class="w-5 h-5 text-yellow-400"
                                    >
                                        <path
                                            d="M9.949 2.424l1.414 4.393h4.63c.417 0 .593.542.255.816l-3.546 2.772 1.33 4.125c.11.34-.294.617-.577.423l-3.507-2.305-3.506 2.305c-.284.194-.688-.083-.578-.423l1.33-4.125-3.546-2.772c-.338-.274-.162-.816.255-.816h4.63l1.414-4.393z"
                                        />
                                    </svg>
                                    <svg
                                        v-else
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                        class="w-5 h-5 text-gray-300"
                                    >
                                        <path
                                            d="M9.949 2.424l1.414 4.393h4.63c.417 0 .593.542.255.816l-3.546 2.772 1.33 4.125c.11.34-.294.617-.577.423l-3.507-2.305-3.506 2.305c-.284.194-.688-.083-.578-.423l1.33-4.125-3.546-2.772c-.338-.274-.162-.816.255-.816h4.63l1.414-4.393z"
                                        />
                                    </svg>
                                </template>
                            </div>
                            <span class="ml-2 text-gray-600">
                                {{ stylelist.review_count }}口コミ
                            </span>
                        </div>
                        <Link
                            as="button"
                            class="px-4 py-2 font-bold text-white bg-gray-500 rounded-full hover:bg-gray-700"
                            >予約</Link
                        >
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
