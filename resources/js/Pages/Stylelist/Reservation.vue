<script setup>
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref, reactive } from 'vue';
import MicroModal from '@/Components/MicroModal.vue';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({ stylelists: Array, errors: Object, items: Array });
const today = new Date().toISOString().split('T')[0];
const maxDate = new Date();
maxDate.setMonth(maxDate.getMonth() + 1);
const maxDateStr = maxDate.toISOString().split('T')[0];
const selectedStyle = ref('');
const selectedStylist = ref('');
const selectedDate = ref(today);
const selectedTime = ref('');

const timeOptions = [
  '09:00',
  '09:30',
  '10:00',
  '10:30',
  '11:00',
  '11:30',
  '12:00',
  '12:30',
  '13:00',
  '13:30',
  '14:00',
  '14:30',
  '15:00',
  '15:30',
  '16:00',
  '16:30',
  '17:00',
  '17:30',
  '18:00',
  '18:30',
  // 추가 시간대 옵션
];

const form = reactive({
  customer_id: null,
  item_id: null,
  stylelist_id: null,
  date: today,
  time: null,
});

const setCustomerId = (id) => {
  form.customer_id = id;
};

const submitReservation = () => {
  form.item_id = Number(selectedStyle.value);
  form.stylelist_id = Number(selectedStylist.value);
  form.time = selectedTime.value;
  // 서버로 데이터 전송
  Inertia.post(route('reservations.store'), form);
};
</script>

<template>
  <Head title="予約" />
  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">予約</h2>
    </template>
    <div class="container p-6 mx-auto">
      <div class="max-w-xl mx-auto overflow-hidden bg-white rounded-lg shadow-md">
        <div class="p-6">
          <form @submit.prevent="submitReservation" class="space-y-6">
            <div class="text-center">
              <h2 class="text-xl font-semibold text-gray-800">美容院予約</h2>
            </div>

            <!-- 사용자 이름 입력 필드 -->
            <div>
              <label for="name" class="text-sm leading-7 text-gray-600">姓名</label>
              <MicroModal @update:customerId="setCustomerId" />
              <div v-if="props.errors.customer_id" class="mt-2 text-red-400">
                {{ props.errors.customer_id }}
              </div>
            </div>

            <!-- 헤어스타일 선택 필드 -->
            <div>
              <label for="style" class="text-sm leading-7 text-gray-600">サービス選択</label>
              <select id="style" v-model="selectedStyle" class="w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded focus:border-indigo-500 focus:bg-white">
                <option value="" disabled>サービス選択</option>
                <option v-for="item in items" :key="item.id" :value="item.id">
                  {{ item.name }}
                  <!-- 예: 아이템 이름을 사용 -->
                </option>
              </select>
            </div>

            <!-- 디자이너 선택 필드 -->
            <div>
              <label for="designer" class="text-sm leading-7 text-gray-600">デザイナー選択</label>
              <select id="designer" v-model="selectedStylist" class="w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded focus:border-indigo-500 focus:bg-white">
                <option value="" disabled>デザイナー選択</option>
                <option v-for="stylist in stylelists" :key="stylist.id" :value="stylist.id">
                  {{ stylist.name }}
                </option>
              </select>
            </div>

            <!-- 예약 날짜 선택 필드 -->
            <div>
              <label for="date" class="text-sm leading-7 text-gray-600">予約日付</label>
              <input type="date" id="date" v-model="selectedDate" :min="today" :max="maxDateStr" class="w-full px-3 py-2 text-base leading-8 text-gray-700 bg-gray-100 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white" required />
            </div>
            <div>
              <label for="time" class="text-sm leading-7 text-gray-600">時間帯</label>
              <select id="time" v-model="selectedTime" class="w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded focus:border-indigo-500 focus:bg-white">
                <option value="" disabled>時間帯選択</option>
                <option v-for="time in timeOptions" :key="time" :value="time">
                  {{ time }}
                </option>
              </select>
            </div>

            <!-- 예약 버튼 -->
            <div class="text-center">
              <button class="px-8 py-2 mt-4 text-lg text-white bg-indigo-500 border-0 rounded hover:bg-indigo-600 focus:outline-none">予約する</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
