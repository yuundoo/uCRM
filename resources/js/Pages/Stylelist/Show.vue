<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/inertia-vue3';
import { onMounted, reactive } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { ref } from 'vue';
const props = defineProps({
  stylelist: Object,
  errors: Object,
  review: Object,
  customer_id: Object,
});

const form = reactive({
  stylelist_id: props.stylelist.id,
  customer_id: props.customer_id,
  content: null,
});

const insertComment = () => {
  Inertia.post(route('reviews.store'), form), (form.content = '');
  console.log(form);
};

const formatDate = (dateString) => {
  const date = new Date(dateString);
  return date.toISOString().split('T')[0];
};

const isDropdownOpen = ref(false);

const toggleDropdown = () => {
  console.log('toggleDropdown 함수 호출');
  isDropdownOpen.value = !isDropdownOpen.value;
};
</script>

<template>
  <Head title="デザイナー詳細" />
  <AuthenticatedLayout>
    <template #header>
      <Link as="button" :href="route('stylelists.index')" class="text-xl font-semibold leading-tight text-gray-800">デザイナー詳細</Link>
    </template>
    <div
      class="flex flex-col items-center justify-center p-6"
      :style="{
        backgroundImage: 'url(/images/showCover.jpg)',
        backgroundPosition: 'center center',
        backgroundSize: 'cover',
      }">
      <div class="w-full max-w-sm overflow-hidden text-center bg-white rounded-lg shadow-lg">
        <!-- 이미지 -->
        <img class="object-cover w-full h-64" :src="stylelist.profile_image" alt="Designer Profile Image" />
        <!-- 내용 -->
        <div class="px-6 py-4">
          <div class="mb-2 text-xl font-bold">
            {{ stylelist.name }}
          </div>
          <div class="flex items-center justify-center p-2 mt-2">
            <div class="text-purple-600">口コミ {{ stylelist.review_count }}</div>
          </div>
          <p class="mb-4 text-base text-gray-700">
            {{ stylelist.description }}
          </p>
          <!-- 태그 -->
          <div class="mb-4">
            <template v-for="tag in stylelist.tags" :key="tag">
              <span class="inline-block px-3 py-1.5 mr-3 text-xs font-semibold text-pink-600 bg-pink-200 rounded-full">人気スタイル</span>
              <span class="inline-block px-3 py-1 mr-2 text-sm font-semibold text-gray-700 bg-gray-200 rounded-full">#{{ tag }}</span>
            </template>
          </div>
          <!-- 인스타그램 링크 -->
          <div class="mb-4">
            <a href="https://www.instagram.com/yuki_chae.a" class="text-blue-500 hover:text-blue-800">https://www.instagram.com/tyi02038</a>
          </div>
          <!-- 소셜 미디어 버튼 -->
          <div class="flex justify-center gap-4">
            <button class="px-4 py-2 font-bold text-white bg-gray-500 rounded-full hover:bg-gray-700">問い合わせ</button>
            <button class="px-4 py-2 font-bold text-white bg-gray-500 rounded-full hover:bg-blue-700">共有</button>
          </div>
        </div>
      </div>
    </div>
    <section class="py-8 antialiased bg-white dark:bg-gray-900 lg:py-16">
      <div class="max-w-2xl px-4 mx-auto">
        <div class="flex items-center justify-between mb-6">
          <h2 class="text-lg font-bold text-gray-900 lg:text-2xl dark:text-white">コメント</h2>
        </div>
        <form @submit.prevent="insertComment" class="mb-6">
          <div class="px-4 py-2 mb-4 bg-white border border-gray-200 rounded-lg rounded-t-lg dark:bg-gray-800 dark:border-gray-700">
            <textarea id="comment" v-model="form.content" rows="6" class="w-full px-0 text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800" placeholder="Write a comment..."></textarea>
          </div>
          <div v-if="props.errors.content" class="mt-2 text-red-400">
            {{ props.errors.content }}
          </div>
          <button type="submit" class="inline-flex items-center bg-gray-500 mt-3 py-2.5 px-4 text-xs font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">コメント作成</button>
        </form>
        <article v-for="comment in review" :key="comment.id" class="p-6 text-base bg-white rounded-lg dark:bg-gray-900">
          <footer class="flex items-center justify-between mb-2">
            <div class="flex items-center">
              <p class="inline-flex items-center mr-3 text-sm font-semibold text-gray-900 dark:text-white">
                <img class="w-6 h-6 mr-2 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-2.jpg" alt="Michael Gough" />
                {{ comment.customer.username }}
                <span v-if="comment.customer.role === 'admin'" class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-medium bg-red-100 text-red-800">管理者</span>
              </p>
              <p class="text-sm text-gray-600 dark:text-gray-400">
                <time pubdate datetime="2022-02-08" title="February 8th, 2022">{{ formatDate(comment.created_at) }}</time>
              </p>
            </div>
            <button id="dropdownComment1Button" data-dropdown-toggle="dropdownComment1" @click="toggleDropdown" class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 bg-white rounded-lg dark:text-gray-400 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-700 dark:focus:ring-gray-600" type="button">
              <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
              </svg>
              <span class="sr-only">Comment settings</span>
            </button>
            <!-- Dropdown menu -->
            <!-- <div
                            id="dropdownComment1"
                            v-if="isDropdownOpen"
                            class="absolute mt-2 bg-white divide-y divide-gray-100 rounded shadow w-36 dark:bg-gray-700 dark:divide-gray-600"
                        >
                            <ul
                                class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                aria-labelledby="dropdownMenuIconHorizontalButton"
                            >
                                <li>
                                    <a
                                        href="#"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                        >Edit</a
                                    >
                                </li>
                                <li>
                                    <a
                                        href="#"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                        >Remove</a
                                    >
                                </li>
                                <li>
                                    <a
                                        href="#"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                        >Report</a
                                    >
                                </li>
                            </ul>
                        </div> -->
          </footer>
          <p class="text-gray-500 dark:text-gray-400">
            {{ comment.content }}
          </p>
        </article>
      </div>
    </section>
  </AuthenticatedLayout>
</template>
