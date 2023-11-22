<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { Link } from "@inertiajs/inertia-vue3";
import FlashMessage from "@/Components/FlashMessage.vue";
import Pagination from "@/Components/Pagination.vue";
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";
defineProps({
    customers: Object,
});

const search = ref("");

const searchCustomers = () => {
    Inertia.get(route("customers.index", { search: search.value }));
};
</script>

<template>
    <Head title="お客一覧" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                お客一覧
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <section class="text-gray-600 body-font">
                            <div class="container px-5 py-8 mx-auto">
                                <FlashMessage />
                                <div
                                    class="flex w-full pl-4 mx-auto my-4 lg:w-2/3"
                                >
                                    <input
                                        v-model="search"
                                        type="text"
                                        name="search"
                                        placeholder="入力..."
                                        class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    />

                                    <button
                                        @click="searchCustomers"
                                        class="px-4 py-2 ml-2 text-white bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline"
                                    >
                                        検索
                                    </button>

                                    <Link
                                        as="button"
                                        :href="route('customers.index')"
                                        class="px-4 py-2 ml-2 text-white bg-red-500 rounded hover:bg-red-700 focus:outline-none focus:shadow-outline"
                                    >
                                        リセット
                                    </Link>

                                    <Link
                                        :href="route('customers.create')"
                                        as="button"
                                        class="flex px-3 py-2 ml-2 text-white bg-indigo-500 border-0 rounded cursor-pointer focus:outline-none hover:bg-indigo-600"
                                    >
                                        お客登録
                                    </Link>
                                </div>
                                <div
                                    class="w-full mx-auto overflow-auto lg:w-2/3"
                                >
                                    <table
                                        class="w-full text-left whitespace-no-wrap table-auto"
                                    >
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
                                                    カナ
                                                </th>
                                                <th
                                                    class="px-4 py-3 text-sm font-medium tracking-wider text-gray-900 bg-gray-100 title-font"
                                                >
                                                    電話番号
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr
                                                v-for="customer in customers.data"
                                                :key="customer.id"
                                            >
                                                <td
                                                    class="px-4 py-3 border-b-2 border-gray-200"
                                                >
                                                    <Link
                                                        class="text-blue-400"
                                                        :href="
                                                            route(
                                                                'customers.show',
                                                                {
                                                                    customer:
                                                                        customer.id,
                                                                }
                                                            )
                                                        "
                                                    >
                                                        {{ customer.id }}
                                                    </Link>
                                                </td>
                                                <td
                                                    class="px-4 py-3 border-b-2 border-gray-200"
                                                >
                                                    {{ customer.username }}
                                                </td>
                                                <td
                                                    class="px-4 py-3 border-b-2 border-gray-200"
                                                >
                                                    {{ customer.kana }}
                                                </td>
                                                <td
                                                    class="px-4 py-3 border-b-2 border-gray-200"
                                                >
                                                    {{ customer.tel }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <Pagination
                                class="flex justify-center"
                                :links="customers.links"
                            ></Pagination>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
