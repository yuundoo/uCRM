<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { reactive } from "vue";
import { Inertia } from "@inertiajs/inertia";

const props = defineProps({ item: Object, errors: Object });

const form = reactive({
    id: props.item.id,
    name: props.item.name,
    memo: props.item.memo,
    price: props.item.price,
    is_selling: props.item.is_selling,
});

const updateItem = (id) => {
    Inertia.put(route("items.update", { item: id }), form);
};
</script>

<template>
    <Head title="商品編集" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                商品編集
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <section class="relative text-gray-600 body-font">
                            <form @submit.prevent="updateItem(form.id)">
                                <div class="container px-5 py-8 mx-auto">
                                    <div class="mx-auto lg:w-1/2 md:w-2/3">
                                        <div class="flex flex-wrap -m-2">
                                            <div class="w-full p-2">
                                                <div class="relative">
                                                    <label
                                                        for="name"
                                                        class="text-sm leading-7 text-gray-600"
                                                        >商品名</label
                                                    >
                                                    <input
                                                        type="text"
                                                        id="name"
                                                        name="name"
                                                        v-model="form.name"
                                                        class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-gray-100 bg-opacity-50 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200"
                                                    />
                                                    <div
                                                        v-if="errors.name"
                                                        class="mt-2 text-red-400"
                                                    >
                                                        {{ props.errors.name }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="w-full p-2">
                                                <div class="relative">
                                                    <label
                                                        for="memo"
                                                        class="text-sm leading-7 text-gray-600"
                                                        >説明</label
                                                    >
                                                    <textarea
                                                        id="memo"
                                                        name="memo"
                                                        v-model="form.memo"
                                                        class="w-full h-32 px-3 py-1 text-base leading-6 text-gray-700 transition-colors duration-200 ease-in-out bg-gray-100 bg-opacity-50 border border-gray-300 rounded outline-none resize-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200"
                                                    ></textarea>
                                                    <div
                                                        v-if="errors.memo"
                                                        class="mt-2 text-red-400"
                                                    >
                                                        {{ props.errors.memo }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="w-full p-2">
                                                <div class="relative">
                                                    <label
                                                        for="price"
                                                        class="text-sm leading-7 text-gray-600"
                                                        >価格</label
                                                    >
                                                    <input
                                                        type="number"
                                                        id="price"
                                                        name="price"
                                                        v-model="form.price"
                                                        class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-gray-100 bg-opacity-50 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200"
                                                    />
                                                    <div
                                                        v-if="errors.price"
                                                        class="mt-2 text-red-400"
                                                    >
                                                        {{ props.errors.price }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="w-full p-2">
                                                <div class="relative">
                                                    <label
                                                        for="is_selling"
                                                        class="text-sm leading-7 text-gray-600"
                                                        >ステータス</label
                                                    >
                                                    <div
                                                        class="flex items-center mt-2"
                                                    >
                                                        <input
                                                            type="radio"
                                                            id="is_selling_on"
                                                            name="is_selling"
                                                            v-model="
                                                                form.is_selling
                                                            "
                                                            value="1"
                                                            class="w-4 h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500"
                                                        />
                                                        <label
                                                            for="is_selling_on"
                                                            class="ml-2 text-sm font-medium text-gray-600"
                                                        >
                                                            販売中
                                                        </label>
                                                    </div>
                                                    <div
                                                        class="flex items-center mt-2"
                                                    >
                                                        <input
                                                            type="radio"
                                                            id="is_selling_off"
                                                            name="is_selling"
                                                            v-model="
                                                                form.is_selling
                                                            "
                                                            value="0"
                                                            class="w-4 h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500"
                                                        />
                                                        <label
                                                            for="is_selling_off"
                                                            class="ml-2 text-sm font-medium text-gray-600"
                                                        >
                                                            停止中
                                                        </label>
                                                    </div>
                                                    <div
                                                        v-if="errors.is_selling"
                                                        class="mt-2 text-red-400"
                                                    >
                                                        {{
                                                            props.errors
                                                                .is_selling
                                                        }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="w-full p-2">
                                                <button
                                                    class="flex px-8 py-2 mx-auto text-lg text-white bg-indigo-500 border-0 rounded focus:outline-none hover:bg-indigo-600"
                                                >
                                                    編集する
                                                </button>
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
