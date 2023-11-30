<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/inertia-vue3";
import { Link } from "@inertiajs/inertia-vue3";
import { onMounted } from "vue";
const props = defineProps({ reservation: Object });

const formatDate = (dateString) => {
    const date = new Date(dateString);
    return date.toISOString().split("T")[0];
};

const formatTime = (timeString) => {
    // UTC를 사용하지 않고 로컬 시간으로 파싱
    const time = new Date("1970-01-01T" + timeString);
    return time.toLocaleTimeString([], {
        hour: "2-digit",
        minute: "2-digit",
        hour12: false,
    });
};
</script>
<template>
    <Head title="予約履歴 詳細画面" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                予約履歴 詳細画面
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
                                                        >予約日</label
                                                    >
                                                    <div
                                                        id="date"
                                                        name="date"
                                                        class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-gray-100 bg-opacity-50 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200"
                                                    >
                                                        {{
                                                            formatDate(
                                                                props
                                                                    .reservation
                                                                    .created_at
                                                            )
                                                        }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="w-full p-2">
                                                <div class="relative">
                                                    <label
                                                        for="time"
                                                        class="text-sm leading-7 text-gray-600"
                                                        >時間帯</label
                                                    >
                                                    <div
                                                        id="time"
                                                        name="time"
                                                        class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-gray-100 bg-opacity-50 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200"
                                                    >
                                                        {{
                                                            formatTime(
                                                                props
                                                                    .reservation
                                                                    .time
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
                                                            props.reservation
                                                                .customer
                                                                .username
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
                                                                    スタイル
                                                                </th>
                                                                <th
                                                                    class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase border-b-2 border-gray-200"
                                                                >
                                                                    価格
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr
                                                                class="hover:bg-gray-100"
                                                            >
                                                                <td
                                                                    class="px-5 py-5 text-sm bg-white border-b border-gray-200"
                                                                >
                                                                    {{
                                                                        props
                                                                            .reservation
                                                                            .item
                                                                            .id
                                                                    }}
                                                                </td>
                                                                <td
                                                                    class="px-5 py-5 text-sm bg-white border-b border-gray-200"
                                                                >
                                                                    {{
                                                                        props
                                                                            .reservation
                                                                            .item
                                                                            .name
                                                                    }}
                                                                </td>
                                                                <td
                                                                    class="px-5 py-5 text-sm bg-white border-b border-gray-200"
                                                                >
                                                                    {{
                                                                        props
                                                                            .reservation
                                                                            .item
                                                                            .price
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
                                                            props.reservation
                                                                .status ==
                                                            'reservated'
                                                        "
                                                        id="username"
                                                        name="username"
                                                        class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-gray-100 bg-opacity-50 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200"
                                                    >
                                                        未キャンセル
                                                    </div>
                                                    <div
                                                        v-else
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
                                                            props.reservation
                                                                .status ==
                                                            'reservated'
                                                        "
                                                        id="username"
                                                        name="username"
                                                        class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-gray-100 bg-opacity-50 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200"
                                                    >
                                                        まだキャンセルしてません。
                                                    </div>
                                                    <div
                                                        v-else
                                                        id="username"
                                                        name="username"
                                                        class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-gray-100 bg-opacity-50 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200"
                                                    >
                                                        {{
                                                            formatDate(
                                                                props
                                                                    .reservation
                                                                    .updated_at
                                                            )
                                                        }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div
                                                v-if="
                                                    props.reservation.status ==
                                                    'reservated'
                                                "
                                                class="w-full p-2"
                                            >
                                                <div
                                                    class="flex justify-between"
                                                >
                                                    <Link
                                                        as="button"
                                                        :href="
                                                            route(
                                                                'purchases.edit',
                                                                {
                                                                    purchase:
                                                                        props
                                                                            .reservation
                                                                            .id,
                                                                }
                                                            )
                                                        "
                                                        class="px-6 py-3 text-white bg-indigo-500 rounded hover:bg-indigo-600 focus:outline-none focus:shadow-outline"
                                                    >
                                                        編集する
                                                    </Link>
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
