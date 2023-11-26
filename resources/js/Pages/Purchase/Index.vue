<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/inertia-vue3';
import FlashMessage from '@/Components/FlashMessage.vue';
import Pagination from '@/Components/Pagination.vue';
import { onMounted, ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
   orders: Object,
});

onMounted(() => {
   console.log(props.orders.data);
});

const search = ref('');

const searchCustomers = () => {
   Inertia.get(route('purchases.index', { search: search.value }));
};

const formatDate = dateString => {
   const date = new Date(dateString);
   return date.toISOString().split('T')[0];
};
</script>

<template>
   <Head title="購買履歴" />

   <AuthenticatedLayout>
      <template #header>
         <h2 class="text-xl font-semibold leading-tight text-gray-800">購買履歴</h2>
      </template>

      <div class="py-12">
         <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
               <div class="p-6 text-gray-900">
                  <section class="text-gray-600 body-font">
                     <div class="container px-5 py-8 mx-auto">
                        <FlashMessage />
                        <div class="flex w-full pl-4 mx-auto my-4 space-x-2 lg:w-2/3">
                           <input
                              v-model="search"
                              type="text"
                              name="search"
                              placeholder="入力..."
                              class="w-3/4 px-3 py-1 leading-tight text-gray-700 border border-gray-300 rounded shadow-sm focus:outline-none focus:border-blue-300"
                           />

                           <button
                              @click="searchCustomers"
                              class="px-3 py-1 text-sm text-white bg-blue-400 rounded hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-300"
                           >
                              検索
                           </button>

                           <Link
                              as="button"
                              :href="route('purchases.index')"
                              class="px-3 py-1 text-sm text-white bg-red-400 rounded hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-300"
                           >
                              リセット
                           </Link>
                        </div>
                        <div class="w-full mx-auto overflow-auto lg:w-2/3">
                           <table class="w-full text-left whitespace-no-wrap table-auto">
                              <thead>
                                 <tr>
                                    <th
                                       class="px-4 py-3 text-sm font-medium tracking-wider text-gray-900 bg-gray-100 rounded-tl rounded-bl title-font"
                                    >
                                       ID
                                    </th>
                                    <th
                                       class="px-4 py-3 text-sm font-medium tracking-wider text-gray-900 bg-gray-100 title-font"
                                    >
                                       氏名
                                    </th>
                                    <th
                                       class="px-4 py-3 text-sm font-medium tracking-wider text-gray-900 bg-gray-100 title-font"
                                    >
                                       購買名
                                    </th>
                                    <th
                                       class="px-4 py-3 text-sm font-medium tracking-wider text-gray-900 bg-gray-100 title-font"
                                    >
                                       合計金額
                                    </th>
                                    <th
                                       class="px-4 py-3 text-sm font-medium tracking-wider text-gray-900 bg-gray-100 title-font"
                                    >
                                       ステータス
                                    </th>
                                    <th
                                       class="px-4 py-3 text-sm font-medium tracking-wider text-gray-900 bg-gray-100 title-font"
                                    >
                                       購入日
                                    </th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr v-for="order in props.orders.data" :key="order.id">
                                    <td class="px-4 py-3 border-b-2 border-gray-200">
                                       <Link
                                          class="text-blue-400"
                                          :href="
                                             route('purchases.show', {
                                                purchase: order.id,
                                             })
                                          "
                                       >
                                          {{ order.id }}
                                       </Link>
                                    </td>

                                    <td class="px-4 py-3 border-b-2 border-gray-200">
                                       {{ order.customer_name }}
                                    </td>
                                    <td class="px-4 py-3 border-b-2 border-gray-200">
                                       {{ order.item_name }}
                                    </td>
                                    <td class="px-4 py-3 border-b-2 border-gray-200">
                                       {{ order.total }}
                                    </td>
                                    <td class="px-4 py-3 border-b-2 border-gray-200">
                                       <span v-if="order.status === 1">未キャンセル</span>
                                       <span v-else>キャンセル</span>
                                    </td>
                                    <td class="px-4 py-3 border-b-2 border-gray-200">
                                       {{ formatDate(order.created_at) }}
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <Pagination class="flex justify-center" :links="props.orders.links"></Pagination>
                  </section>
               </div>
            </div>
         </div>
      </div>
   </AuthenticatedLayout>
</template>
