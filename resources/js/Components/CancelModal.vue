<script setup>
import { ref } from "vue";

const showModal = ref(false);

const closeModal = () => {
    showModal.value = false;
};
</script>

<template>
    <div
        v-if="showModal"
        class="fixed inset-0 w-full h-full overflow-y-auto bg-gray-600 bg-opacity-50"
        id="my-modal"
    >
        <div
            class="relative p-5 mx-auto bg-white border rounded-md shadow-lg top-20 w-96"
        >
            <div class="mt-3 text-center">
                <div
                    class="flex items-center justify-center w-12 h-12 mx-auto bg-green-100 rounded-full"
                >
                    <!-- 아이콘 또는 이미지 삽입 -->
                </div>
                <h3 class="text-lg font-medium leading-6 text-gray-900">
                    미지정정보부족 30% (최대 20%)
                </h3>
                <span class="text-gray-500">2022. 10. 17(월) 오전 10:30</span>
                <div class="py-3 mt-2 px-7">
                    <p class="text-sm text-gray-500">
                        예약을 취소하시는 사유를 입력해주세요.
                    </p>
                    <textarea
                        class="w-full px-3 py-2 mt-1 text-sm bg-white border rounded-md"
                    ></textarea>
                </div>
                <div class="items-center px-4 py-3">
                    <button
                        id="ok-btn"
                        @click="confirmCancel"
                        class="w-5/12 px-4 py-2 text-base font-medium text-white bg-green-500 rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-300"
                    >
                        예
                    </button>
                    <button
                        id="cancel-btn"
                        @click="closeModal"
                        class="w-5/12 px-4 py-2 text-base font-medium text-green-500 bg-white rounded-md shadow-sm hover:text-green-700 focus:outline-none focus:ring-2 focus:ring-green-300"
                    >
                        아니요
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
