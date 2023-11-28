<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { Link } from "@inertiajs/inertia-vue3";
import { onMounted } from "vue";
const props = defineProps({ stylelist: Object });

onMounted(() => {
    console.log(props.stylelist);
});
</script>

<template>
    <Head title="デザイナー詳細" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                デザイナー詳細
            </h2>
        </template>
        <div class="flex flex-col items-center justify-center p-6">
            <div
                class="w-full max-w-sm overflow-hidden text-center bg-white rounded-lg shadow-lg"
            >
                <!-- 이미지 -->
                <img
                    class="object-cover w-full h-64"
                    :src="stylelist.profile_image"
                    alt="Designer Profile Image"
                />
                <!-- 내용 -->
                <div class="px-6 py-4">
                    <div class="mb-2 text-xl font-bold">
                        {{ stylelist.name }}
                    </div>
                    <p class="mb-4 text-base text-gray-700">
                        {{ stylelist.description }}
                    </p>
                    <!-- 태그 -->
                    <div class="mb-4">
                        <template v-for="tag in stylelist.tags" :key="tag">
                            <span
                                class="inline-block px-3 py-1 mr-2 text-sm font-semibold text-gray-700 bg-gray-200 rounded-full"
                            >
                                #{{ tag }}
                            </span>
                        </template>
                    </div>
                    <!-- 인스타그램 링크 -->
                    <div class="mb-4">
                        <a
                            href="https://www.instagram.com/yuki_chae.a"
                            class="text-blue-500 hover:text-blue-800"
                        >
                            https://www.instagram.com/yuki_chae.a
                        </a>
                    </div>
                    <!-- 소셜 미디어 버튼 -->
                    <div class="flex justify-center gap-4">
                        <button
                            class="px-4 py-2 font-bold text-white bg-gray-500 rounded-full hover:bg-green-700"
                        >
                            予約
                        </button>
                        <button
                            class="px-4 py-2 font-bold text-white bg-gray-500 rounded-full hover:bg-gray-700"
                        >
                            問い合わせ
                        </button>
                        <button
                            class="px-4 py-2 font-bold text-white bg-gray-500 rounded-full hover:bg-blue-700"
                        >
                            共有
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
