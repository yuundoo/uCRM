<script setup>
// 예약 데이터 배열
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { Link } from "@inertiajs/inertia-vue3";
import { onMounted } from "vue";
onMounted(() => {
    console.log(props.reservations);
});
const props = defineProps({ reservations: Object });
</script>
<template>
    <Head title="お客様の予約" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    お客様の予約
                </h2>
            </div>
        </template>
        <div class="container p-4 mx-auto">
            <div v-if="reservations.length" class="space-y-6">
                <!-- 예약 리스트를 반복하여 표시하는 반복문 -->
                <div
                    v-for="reservation in reservations"
                    :key="reservation.id"
                    class="flex overflow-hidden bg-white shadow-lg rounded-xl"
                >
                    <!-- 예약 정보 -->
                    <div class="flex items-start w-full px-4 py-2 space-x-4">
                        <div class="flex flex-col justify-between w-full">
                            <div>
                                <h3 class="text-lg font-bold">
                                    {{ reservation.item.name }}
                                </h3>
                                <p class="text-gray-500">
                                    {{ reservation.date }} &nbsp;{{
                                        reservation.time
                                    }}
                                </p>
                            </div>
                            <div class="font-semibold text-gray-700">
                                {{ reservation.item.price }}円
                            </div>
                        </div>
                    </div>

                    <!-- 액션 버튼들 -->
                    <div class="flex justify-between p-6 bg-gray-50">
                        <button
                            class="mr-2 font-semibold text-indigo-600 hover:text-indigo-800"
                        >
                            詳細
                        </button>
                        <button
                            class="font-semibold text-red-600 hover:text-red-800"
                        >
                            キャンセル
                        </button>
                    </div>
                </div>
                <!-- 반복문 종료 -->
            </div>
            <div v-else class="text-center text-gray-500">
                <p>予約リストがございません。</p>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
