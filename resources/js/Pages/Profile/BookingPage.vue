<script setup>
// 예약 데이터 배열
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Inertia } from '@inertiajs/inertia';
import { Head } from '@inertiajs/vue3';
import { onMounted, reactive, ref } from 'vue';
import FlashMessage from '@/Components/FlashMessage.vue';
import { Link } from '@inertiajs/inertia-vue3';

const formatTime = (timeString) => {
  // UTC를 사용하지 않고 로컬 시간으로 파싱
  const time = new Date('1970-01-01T' + timeString);
  return time.toLocaleTimeString([], {
    hour: '2-digit',
    minute: '2-digit',
    hour12: false,
  });
};
const props = defineProps({ reservations: Object, errors: Object });
onMounted(() => {
  console.log(props.reservations);
});
// 선택된 예약의 상세 정보를 보여줄 변수
const selectedReservationId = ref(null);

// 상세 정보 토글 함수
const toggleDetails = (id) => {
  if (selectedReservationId.value === id) {
    selectedReservationId.value = null; // 이미 선택된 상태라면 토글
  } else {
    selectedReservationId.value = id; // 새로운 예약 선택
  }
};

// 모달 상태 관리를 위한 새로운 상태 추가
const showModalForId = ref(null);

// 취소 버튼 클릭 시 모달을 여는 함수
const openCancelModal = (id) => {
  form.id = id;
  showModalForId.value = id;
};

// 모달을 닫는 함수
const closeModal = () => {
  showModalForId.value = null;
  form.reason = '';
};

const cancelStatus = ref('cancel');

const form = reactive({
  id: props.reservations.id,
  status: props.reservations.status,
  reason: props.reservations.reason,
});

// 취소 확인 버튼 클릭 핸들러
const confirmCancel = (id) => {
  form.status = cancelStatus.value;
  Inertia.put(route('reservations.update', { reservation: id }), form);
  console.log(form);
  closeModal();
};
</script>

<template>
  <Head title="お客様の予約" />
  <AuthenticatedLayout>
    <template #header>
      <div class="flex items-center justify-between">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">お客様の予約</h2>
      </div>
    </template>
    <div class="container p-4 mx-auto">
      <FlashMessage />
      <div v-if="reservations.length" class="space-y-6">
        <!-- 예약 리스트를 반복하여 표시하는 반복문 -->
        <div v-for="reservation in reservations" :key="reservation.id" class="flex overflow-hidden bg-white shadow-lg rounded-xl">
          <!-- 예약 정보 -->
          <div class="flex items-start w-full px-4 py-2 space-x-4">
            <div class="flex flex-col justify-between w-full">
              <div>
                <h3 class="text-lg font-bold">
                  {{ reservation.item.name }}
                </h3>
                <p class="text-gray-500">{{ reservation.date }}日 &nbsp;{{ formatTime(reservation.time) }}分</p>
              </div>
              <div class="font-semibold text-gray-700">{{ reservation.item.price }}円</div>
              <button v-if="reservation.status !== 'cancel'" @click="toggleDetails(reservation.id)" class="flex items-center justify-center w-12 p-2 bg-gray-200 rounded-full hover:bg-gray-300">
                <!-- 화살표 아이콘 -->
                <svg
                  :class="{
                    'rotate-90': selectedReservationId === reservation.id,
                  }"
                  class="w-6 h-6 text-gray-600"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                  xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
              </button>
            </div>
            <div v-if="selectedReservationId === reservation.id" class="flex flex-col justify-center w-1/3 h-full px-6 py-4 bg-gray-100 border-t border-gray-200">
              <div>予約時間: {{ formatTime(reservation.time) }}分</div>
              <div>デザイナー: {{ reservation.stylelist.name }}</div>
            </div>
          </div>

          <!-- 액션 버튼들 -->
          <div v-if="reservation.status === 'cancel'" class="flex flex-col items-center justify-center w-1/6 mr-10 font-semibold text-red-500">キャンセル済</div>
          <div v-else class="w-1/5 p-12">
            <button @click="openCancelModal(reservation.id)" class="flex items-center gap-2 font-semibold text-red-500 hover:text-red-800">
              <span>❌</span>
              キャンセル
            </button>
          </div>

          <div v-if="showModalForId === reservation.id" class="fixed inset-0 w-full h-full overflow-y-auto bg-gray-600 bg-opacity-50" id="my-modal">
            <div class="relative p-5 mx-auto bg-white border rounded-md shadow-lg top-20 w-96">
              <div class="mt-3 text-center">
                <h3 class="p-3 text-lg font-medium leading-6 text-gray-900">
                  {{ reservation.item.name }}
                </h3>
                <span class="text-gray-500">{{ reservation.date }}日 &nbsp;{{ formatTime(reservation.time) }}分</span>
                <div class="py-3 mt-2 px-7">
                  <p class="text-sm text-gray-500">キャンセル理由を入力してください。</p>
                  <textarea v-model="form.reason" class="w-full px-3 py-2 mt-1 text-sm bg-white border rounded-md"></textarea>
                </div>
                <div class="items-center px-4 py-3">
                  <input type="hidden" v-model="cancelStatus" />
                  <button id="ok-btn" @click.prevent="confirmCancel(form.id)" class="w-5/12 px-4 py-2 mr-2 text-base font-medium text-white bg-purple-500 rounded-md shadow-sm hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-green-300">はい</button>
                  <button id="cancel-btn" @click="closeModal" class="w-5/12 px-4 py-2 text-base font-medium text-purple-500 bg-white rounded-md shadow-sm hover:text-purple-700 focus:outline-none focus:ring-2 focus:ring-green-300">いいえ</button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- 반복문 종료 -->
      </div>
      <div v-else class="flex items-center justify-center h-64">
        <div class="text-center">
          <p class="text-lg font-semibold text-gray-700">予約リストがございません。</p>
          <Link :href="route('stylelists.create')" class="mt-2 text-gray-500">新しい予約してください!。</Link>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
