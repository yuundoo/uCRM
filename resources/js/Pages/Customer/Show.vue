<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/inertia-vue3';

defineProps({ customer: Object });
</script>

<template>
  <Head title="顧客詳細" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">顧客詳細</h2>
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            <section class="relative text-gray-600 body-font">
              <form @submit.prevent="storeCustomer">
                <div class="container px-5 py-8 mx-auto">
                  <div class="mx-auto lg:w-1/2 md:w-2/3">
                    <div class="flex flex-wrap -m-2">
                      <div class="w-full p-2">
                        <div class="relative">
                          <label for="username" class="text-sm leading-7 text-gray-600">顧客名</label>
                          <div id="username" class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-gray-100 bg-opacity-50 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200">
                            {{ customer.username }}
                          </div>
                        </div>
                      </div>

                      <div class="w-full p-2">
                        <div class="relative">
                          <label for="kana" class="text-sm leading-7 text-gray-600">顧客名カナ</label>
                          <div id="kana" class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-gray-100 bg-opacity-50 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200">
                            {{ customer.kana }}
                          </div>
                        </div>
                      </div>

                      <div class="w-full p-2">
                        <div class="relative">
                          <label for="tel" class="text-sm leading-7 text-gray-600">電話番号</label>
                          <div type=" tel" id="tel" class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-gray-100 bg-opacity-50 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200">
                            {{ customer.tel }}
                          </div>
                        </div>
                      </div>

                      <div class="w-full p-2">
                        <div class="relative">
                          <label for="email" class="text-sm leading-7 text-gray-600">メール</label>
                          <div id="email" class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-gray-100 bg-opacity-50 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200">
                            {{ customer.email }}
                          </div>
                        </div>
                      </div>

                      <div class="w-full p-2">
                        <div class="relative">
                          <label for="postcode" class="text-sm leading-7 text-gray-600">郵便番号</label>
                          <div id="postcode" class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-gray-100 bg-opacity-50 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200">
                            {{ customer.postcode }}
                          </div>
                        </div>
                      </div>

                      <div class="w-full p-2">
                        <div class="relative">
                          <label for="price" class="text-sm leading-7 text-gray-600">住所</label>
                          <div id="address" class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-gray-100 bg-opacity-50 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200">
                            {{ customer.address }}
                          </div>
                        </div>
                      </div>
                      <div class="w-full p-2">
                        <div class="relative">
                          <label for="birthday" class="text-sm leading-7 text-gray-600">生年月日</label>
                          <div type="date" id="birthday" class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-gray-100 bg-opacity-50 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200">
                            {{ customer.birthday }}
                          </div>
                        </div>
                      </div>
                      <div class="w-full p-2">
                        <div class="relative">
                          <label for="gender" class="text-sm leading-7 text-gray-600">性別</label>
                          <div id="gender" class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-gray-100 bg-opacity-50 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200">
                            <span v-if="customer.gender === 0">男性</span>
                            <span v-if="customer.gender === 1">女性</span>
                            <span v-if="customer.gender === 2">その他</span>
                          </div>
                        </div>
                      </div>
                      <div class="w-full p-2">
                        <div class="relative">
                          <label for="usermemo" class="text-sm leading-7 text-gray-600">説明</label>
                          <!-- 값이 있는 경우 -->
                          <div v-if="customer.usermemo" id="usermemo" class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-gray-100 bg-opacity-50 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200">
                            {{ customer.usermemo }}
                          </div>

                          <!-- 값이 없는 경우 (텍스트 영역으로 표시) -->
                          <textarea v-else disabled id="usermemo" class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition duration-200 ease-in-out bg-gray-100 border border-gray-300 rounded focus:border-indigo-500 focus:bg-white focus:ring focus:ring-indigo-200" placeholder="入力してください。。。"></textarea>
                        </div>
                      </div>
                      <div class="flex justify-between w-full p-2">
                        <Link
                          as="button"
                          class="px-8 py-2 text-lg text-white bg-indigo-500 border-0 rounded focus:outline-none hover:bg-indigo-600"
                          :href="
                            route('customers.edit', {
                              customer: customer.id,
                            })
                          ">
                          顧客編集
                        </Link>
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
