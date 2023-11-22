<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/inertia-vue3";
import { onMounted } from "vue";
const props = defineProps({ item: Array, order: Array });

const formatDate = (dateString) => {
    const date = new Date(dateString);
    return date.toISOString().split("T")[0];
};

onMounted(() => {
    console.log(props.order[0]);
    console.log(props.item);
});
</script>
<template>
    <Head title="購買履歴 詳細画面" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                購買履歴 詳細画面
            </h2>
        </template>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <section class="relative text-gray-600 body-font">
                            <form @submit.prevent="storePurchase">
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
                                                    <div
                                                        type="date"
                                                        id="date"
                                                        name="date"
                                                        class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-gray-100 bg-opacity-50 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200"
                                                    >
                                                        {{
                                                            formatDate(
                                                                props.order[0]
                                                                    .created_at
                                                            )
                                                        }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="w-full p-2">
                                                <div class="relative">
                                                    <label
                                                        for="username"
                                                        class="text-sm leading-7 text-gray-600"
                                                        >会員名</label
                                                    ><br />
                                                    <div
                                                        id="username"
                                                        name="username"
                                                        class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-gray-100 bg-opacity-50 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200"
                                                    >
                                                        {{
                                                            props.order[0]
                                                                .customer_name
                                                        }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="w-full p-2">
                                                <div>
                                                    <label
                                                        for="name"
                                                        class="text-sm leading-7 text-gray-600"
                                                    >
                                                        商品・サービス
                                                    </label>
                                                    <table
                                                        class="min-w-full leading-normal"
                                                    >
                                                        <thead>
                                                            <tr
                                                                class="bg-gray-100"
                                                            >
                                                                <th
                                                                    class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase border-b-2 border-gray-200"
                                                                >
                                                                    ID
                                                                </th>
                                                                <th
                                                                    class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase border-b-2 border-gray-200"
                                                                >
                                                                    名前
                                                                </th>
                                                                <th
                                                                    class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase border-b-2 border-gray-200"
                                                                >
                                                                    価格
                                                                </th>
                                                                <th
                                                                    class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase border-b-2 border-gray-200"
                                                                >
                                                                    数量
                                                                </th>
                                                                <th
                                                                    class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase border-b-2 border-gray-200"
                                                                >
                                                                    合計
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr
                                                                v-for="item in props.item"
                                                                :key="item.id"
                                                                class="hover:bg-gray-100"
                                                            >
                                                                <td
                                                                    class="px-5 py-5 text-sm bg-white border-b border-gray-200"
                                                                >
                                                                    {{
                                                                        item.id
                                                                    }}
                                                                </td>
                                                                <td
                                                                    class="px-5 py-5 text-sm bg-white border-b border-gray-200"
                                                                >
                                                                    {{
                                                                        item.item_name
                                                                    }}
                                                                </td>
                                                                <td
                                                                    class="px-5 py-5 text-sm bg-white border-b border-gray-200"
                                                                >
                                                                    {{
                                                                        item.item_price
                                                                    }}
                                                                </td>
                                                                <td
                                                                    class="px-5 py-5 text-sm bg-white border-b border-gray-200"
                                                                >
                                                                    {{
                                                                        item.quantity
                                                                    }}
                                                                </td>
                                                                <td
                                                                    class="px-5 py-5 text-sm bg-white border-b border-gray-200"
                                                                >
                                                                    {{
                                                                        item.subtotal
                                                                    }}
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="w-full p-2">
                                                <div class="relative">
                                                    <label
                                                        for="username"
                                                        class="text-sm leading-7 text-gray-600"
                                                        >ステータス</label
                                                    ><br />
                                                    <div
                                                        v-if="
                                                            props.order[0]
                                                                .status == true
                                                        "
                                                        id="username"
                                                        name="username"
                                                        class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-gray-100 bg-opacity-50 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200"
                                                    >
                                                        未キャンセル
                                                    </div>
                                                    <div
                                                        v-if="
                                                            props.order[0]
                                                                .status == false
                                                        "
                                                        id="username"
                                                        name="username"
                                                        class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-gray-100 bg-opacity-50 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200"
                                                    >
                                                        キャンセル
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="w-full p-2">
                                                <div class="relative">
                                                    <label
                                                        for="username"
                                                        class="text-sm leading-7 text-gray-600"
                                                        >キャンセル日</label
                                                    ><br />
                                                    <div
                                                        v-if="
                                                            props.order[0]
                                                                .status == true
                                                        "
                                                        id="username"
                                                        name="username"
                                                        class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-gray-100 bg-opacity-50 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200"
                                                    >
                                                        まだキャンセルしてません。
                                                    </div>
                                                    <div
                                                        v-if="
                                                            props.order[0]
                                                                .status == false
                                                        "
                                                        id="username"
                                                        name="username"
                                                        class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-gray-100 bg-opacity-50 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200"
                                                    >
                                                        {{
                                                            formatDate(
                                                                props.order[0]
                                                                    .updated_at
                                                            )
                                                        }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="w-full p-2">
                                                <div>
                                                    <div class="mt-4">
                                                        <strong>合計：</strong>
                                                        <span class="text-lg">{{
                                                            props.order[0].total
                                                        }}</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="w-full p-2">
                                                <div
                                                    class="flex justify-between"
                                                >
                                                    <button
                                                        class="px-6 py-3 text-white bg-indigo-500 rounded hover:bg-indigo-600 focus:outline-none focus:shadow-outline"
                                                    >
                                                        編集する
                                                    </button>
                                                    <button
                                                        class="px-6 py-3 text-white bg-indigo-500 rounded hover:bg-indigo-600 focus:outline-none focus:shadow-outline"
                                                    >
                                                        登録する
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
