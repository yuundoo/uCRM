<script setup>
import { onMounted, reactive, ref, computed } from "vue";
import { Inertia } from "@inertiajs/inertia";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/inertia-vue3";
const props = defineProps({
    reservation: Object,
    errors: Object,
    stylelists: Object,
    items: Object,
});

const today = new Date().toISOString().split("T")[0];
const maxDate = new Date();
maxDate.setMonth(maxDate.getMonth() + 1);
const maxDateStr = maxDate.toISOString().split("T")[0];
const selectedDate = ref(props.reservation.date);
const selectedTime = ref("");
const selectedStyle = ref(props.reservation.item_id.toString());
const selectedStylist = ref(props.reservation.stylelist_id.toString());

const updatePurchase = (id) => {
    form.item_id = Number(selectedStyle.value);
    form.stylelist_id = Number(selectedStylist.value);
    form.time = selectedTime.value;
    Inertia.put(
        route("purchases.update", { purchase: id }),
        form,
        console.log(form)
    );
};

const form = reactive({
    id: props.reservation.id,
    customer_id: props.reservation.customer_id,
    date: selectedDate.value,
    time: selectedTime.value,
    stylelist_id: selectedStylist.value,
    item_id: selectedStyle.value,
    status: props.reservation.status,
});

const timeOptions = [
    "09:00",
    "09:30",
    "10:00",
    "10:30",
    "11:00",
    "11:30",
    "12:00",
    "12:30",
    "13:00",
    "13:30",
    "14:00",
    "14:30",
    "15:00",
    "15:30",
    "16:00",
    "16:30",
    "17:00",
    "17:30",
    "18:00",
    "18:30",
    // 추가 시간대 옵션
];
</script>
<template>
    <Head title="予約履歴編集" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                予約履歴編集
            </h2>
        </template>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <section class="relative text-gray-600 body-font">
                            <form @submit.prevent="updatePurchase(form.id)">
                                <div class="container px-5 py-8 mx-auto">
                                    <div class="mx-auto lg:w-1/2 md:w-2/3">
                                        <div class="flex flex-wrap -m-2">
                                            <div class="w-full p-2">
                                                <div class="relative">
                                                    <label
                                                        for="date"
                                                        class="text-sm leading-7 text-gray-600"
                                                        >日付</label
                                                    >
                                                    <input
                                                        type="date"
                                                        id="date"
                                                        v-model="selectedDate"
                                                        :min="today"
                                                        :max="maxDateStr"
                                                        class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-gray-100 bg-opacity-50 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200"
                                                    />
                                                </div>
                                            </div>

                                            <div class="w-full p-2">
                                                <div class="relative">
                                                    <label
                                                        for="time"
                                                        class="text-sm leading-7 text-gray-600"
                                                        >時間帯</label
                                                    >
                                                    <select
                                                        id="time"
                                                        v-model="selectedTime"
                                                        class="w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded focus:border-indigo-500 focus:bg-white"
                                                    >
                                                        <option
                                                            value=""
                                                            disabled
                                                        >
                                                            時間帯選択
                                                        </option>
                                                        <option
                                                            v-for="time in timeOptions"
                                                            :key="time"
                                                            :value="time"
                                                        >
                                                            {{ time }}
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="w-full p-2">
                                                <div class="relative">
                                                    <label
                                                        for="username"
                                                        class="text-sm leading-7 text-gray-600"
                                                        >会員名</label
                                                    ><br />
                                                    <input
                                                        type="text"
                                                        id="customer"
                                                        name="customer"
                                                        :value="
                                                            props.reservation
                                                                .customer
                                                                .username
                                                        "
                                                        class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-gray-100 bg-opacity-50 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200"
                                                    />
                                                </div>
                                                <div
                                                    v-if="
                                                        props.errors.customer_id
                                                    "
                                                    class="mt-2 text-red-400"
                                                >
                                                    {{
                                                        props.errors.customer_id
                                                    }}
                                                </div>
                                            </div>

                                            <div class="w-full p-2">
                                                <div class="relative">
                                                    <!-- 헤어스타일 선택 필드 -->

                                                    <label
                                                        for="style"
                                                        class="text-sm leading-7 text-gray-600"
                                                        >サービス選択</label
                                                    >
                                                    <select
                                                        id="style"
                                                        v-model="selectedStyle"
                                                        class="w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded focus:border-indigo-500 focus:bg-white"
                                                    >
                                                        <option
                                                            value=""
                                                            disabled
                                                        >
                                                            サービス選択
                                                        </option>
                                                        <option
                                                            v-for="item in props.items"
                                                            :key="item.id"
                                                            :value="item.id"
                                                        >
                                                            {{ item.name }}
                                                            <!-- 예: 아이템 이름을 사용 -->
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- 디자이너 선택 필드 -->
                                            <div class="w-full p-2">
                                                <div class="relative">
                                                    <label
                                                        for="designer"
                                                        class="text-sm leading-7 text-gray-600"
                                                        >デザイナー選択</label
                                                    >
                                                    <select
                                                        id="designer"
                                                        v-model="
                                                            selectedStylist
                                                        "
                                                        class="w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded focus:border-indigo-500 focus:bg-white"
                                                    >
                                                        <option
                                                            value=""
                                                            disabled
                                                        >
                                                            デザイナー選択
                                                        </option>
                                                        <option
                                                            v-for="stylist in props.stylelists"
                                                            :key="stylist.id"
                                                            :value="stylist.id"
                                                        >
                                                            {{ stylist.name }}
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="w-full p-2">
                                                <div class="relative">
                                                    <label
                                                        for="status"
                                                        class="text-sm leading-7 text-gray-600"
                                                        >ステータス</label
                                                    ><br />
                                                    <div
                                                        class="flex items-center mt-2"
                                                    >
                                                        <input
                                                            type="radio"
                                                            id="is_selling_on"
                                                            name="status"
                                                            v-model="
                                                                form.status
                                                            "
                                                            value="reservated"
                                                            class="w-4 h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500"
                                                        />
                                                        <label
                                                            for="is_selling_off"
                                                            class="ml-2 text-sm font-medium text-gray-600"
                                                        >
                                                            未キャンセル
                                                        </label>
                                                    </div>
                                                    <div
                                                        class="flex items-center mt-2"
                                                    >
                                                        <input
                                                            type="radio"
                                                            id="status_off"
                                                            name="status"
                                                            v-model="
                                                                form.status
                                                            "
                                                            value="cancel"
                                                            class="w-4 h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500"
                                                        />
                                                        <label
                                                            for="is_selling_off"
                                                            class="ml-2 text-sm font-medium text-gray-600"
                                                        >
                                                            キャンセル済
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="w-full p-2">
                                                <div>
                                                    <button
                                                        class="px-6 py-3 text-white bg-indigo-500 rounded hover:bg-indigo-600 focus:outline-none focus:shadow-outline"
                                                    >
                                                        編集する
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
