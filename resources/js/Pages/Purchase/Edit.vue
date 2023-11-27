<script setup>
import { onMounted, reactive, ref, computed } from "vue";
import { Inertia } from "@inertiajs/inertia";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/inertia-vue3";
const props = defineProps({ items: Array, order: Array, errors: Object });

const itemList = ref([]);

onMounted(() => {
    props.items.forEach((item) => {
        itemList.value.push({
            id: item.id,
            name: item.name,
            price: item.price,
            quantity: item.quantity,
        });
    });
});

const totalPrice = computed(() => {
    let total = 0;
    itemList.value.forEach((item) => {
        total += item.price * item.quantity;
    });
    return total;
});

const updatePurchase = (id) => {
    itemList.value.forEach((item) => {
        if (item.quantity > 0)
            form.items.push({ id: item.id, quantity: item.quantity });
    });
    Inertia.put(
        route("purchases.update", { purchase: id }),
        form,
        console.log(form)
    );
};

const formatDate = (dateString) => {
    const date = new Date(dateString);
    return date.toISOString().split("T")[0];
};

const form = reactive({
    id: props.order[0].id,
    customer_id: props.order[0].customer_id,
    date: formatDate(props.order[0].created_at),
    status: props.order[0].status,
    items: [],
});

const quantity = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
</script>
<template>
    <Head title="購買履歴編集" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                購買履歴編集
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
                                                        disabled
                                                        type="date"
                                                        id="date"
                                                        name="date"
                                                        :value="form.date"
                                                        class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-gray-100 bg-opacity-50 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200"
                                                    />
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
                                                            props.order[0]
                                                                .customer_name
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
                                                                v-for="item in itemList"
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
                                                                        item.name
                                                                    }}
                                                                </td>
                                                                <td
                                                                    class="px-5 py-5 text-sm bg-white border-b border-gray-200"
                                                                >
                                                                    {{
                                                                        item.price
                                                                    }}
                                                                </td>
                                                                <td
                                                                    class="px-5 py-5 text-sm bg-white border-b border-gray-200"
                                                                >
                                                                    <select
                                                                        name="quantity"
                                                                        v-model="
                                                                            item.quantity
                                                                        "
                                                                        class="border-gray-300 rounded"
                                                                    >
                                                                        <option
                                                                            v-for="q in quantity"
                                                                            :value="
                                                                                q
                                                                            "
                                                                            :key="
                                                                                q
                                                                            "
                                                                        >
                                                                            {{
                                                                                q
                                                                            }}
                                                                        </option>
                                                                    </select>
                                                                </td>
                                                                <td
                                                                    class="px-5 py-5 text-sm bg-white border-b border-gray-200"
                                                                >
                                                                    {{
                                                                        item.price *
                                                                        item.quantity
                                                                    }}
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="w-full p-2">
                                                <div>
                                                    <div class="mt-4">
                                                        <strong>合計：</strong>
                                                        <span class="text-lg">{{
                                                            totalPrice
                                                        }}</span>
                                                    </div>
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
                                                            value="0"
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
                                                            value="1"
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
