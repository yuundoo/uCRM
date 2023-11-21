<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Core as YubinBangoCore } from "yubinbango-core2";
import { Head } from "@inertiajs/vue3";
import { reactive } from "vue";
import { Inertia } from "@inertiajs/inertia";

defineProps({ errors: Object });

const form = reactive({
    username: null,
    kana: null,
    tel: null,
    email: null,
    postcode: null,
    address: null,
    birthday: null,
    gender: null,
    usermemo: null,
});

const storeCustomer = () => {
    Inertia.post("/customers", form);
};

const fetchAddress = () => {
    new YubinBangoCore(String(form.postcode), (value) => {
        form.address = value.region + value.locality + value.street;
    });
};
</script>

<template>
    <Head title="お客登録" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                お客登録
            </h2>
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
                                                    <label
                                                        for="username"
                                                        class="text-sm leading-7 text-gray-600"
                                                        >顧客名</label
                                                    >
                                                    <input
                                                        type="text"
                                                        id="username"
                                                        name="username"
                                                        v-model="form.username"
                                                        class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-gray-100 bg-opacity-50 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200"
                                                    />
                                                    <div
                                                        v-if="errors.username"
                                                        class="mt-2 text-red-400"
                                                    >
                                                        {{ errors.username }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="w-full p-2">
                                                <div class="relative">
                                                    <label
                                                        for="kana"
                                                        class="text-sm leading-7 text-gray-600"
                                                        >顧客名カナ</label
                                                    >
                                                    <input
                                                        type="text"
                                                        id="kana"
                                                        name="kana"
                                                        v-model="form.kana"
                                                        class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-gray-100 bg-opacity-50 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200"
                                                    />
                                                    <div
                                                        v-if="errors.kana"
                                                        class="mt-2 text-red-400"
                                                    >
                                                        {{ errors.kana }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="w-full p-2">
                                                <div class="relative">
                                                    <label
                                                        for="tel"
                                                        class="text-sm leading-7 text-gray-600"
                                                        >電話番号</label
                                                    >
                                                    <input
                                                        type=" tel"
                                                        id="tel"
                                                        name="tel"
                                                        v-model="form.tel"
                                                        class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-gray-100 bg-opacity-50 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200"
                                                    />
                                                    <div
                                                        v-if="errors.tel"
                                                        class="mt-2 text-red-400"
                                                    >
                                                        {{ errors.tel }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="w-full p-2">
                                                <div class="relative">
                                                    <label
                                                        for="email"
                                                        class="text-sm leading-7 text-gray-600"
                                                        >メール</label
                                                    >
                                                    <input
                                                        type="email"
                                                        id="email"
                                                        name="email"
                                                        v-model="form.email"
                                                        class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-gray-100 bg-opacity-50 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200"
                                                    />
                                                    <div
                                                        v-if="errors.email"
                                                        class="mt-2 text-red-400"
                                                    >
                                                        {{ errors.email }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="w-full p-2">
                                                <div class="relative">
                                                    <label
                                                        for="postcode"
                                                        class="text-sm leading-7 text-gray-600"
                                                        >郵便番号</label
                                                    >
                                                    <input
                                                        type="number"
                                                        id="postcode"
                                                        name="postcode"
                                                        @change="fetchAddress"
                                                        v-model="form.postcode"
                                                        class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-gray-100 bg-opacity-50 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200"
                                                    />
                                                    <div
                                                        v-if="errors.postcode"
                                                        class="mt-2 text-red-400"
                                                    >
                                                        {{ errors.postcode }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="w-full p-2">
                                                <div class="relative">
                                                    <label
                                                        for="price"
                                                        class="text-sm leading-7 text-gray-600"
                                                        >住所</label
                                                    >
                                                    <input
                                                        type="text"
                                                        id="address"
                                                        name="address"
                                                        v-model="form.address"
                                                        class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-gray-100 bg-opacity-50 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200"
                                                    />
                                                    <div
                                                        v-if="errors.address"
                                                        class="mt-2 text-red-400"
                                                    >
                                                        {{ errors.address }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="w-full p-2">
                                                <div class="relative">
                                                    <label
                                                        for="birthday"
                                                        class="text-sm leading-7 text-gray-600"
                                                        >生年月日</label
                                                    >
                                                    <input
                                                        type="date"
                                                        id="birthday"
                                                        name="birthday"
                                                        v-model="form.birthday"
                                                        class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-gray-100 bg-opacity-50 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200"
                                                    />
                                                    <div
                                                        v-if="errors.birthday"
                                                        class="mt-2 text-red-400"
                                                    >
                                                        {{ errors.birthday }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="w-full p-2">
                                                <div class="relative">
                                                    <label
                                                        for="gender"
                                                        class="text-sm leading-7 text-gray-600"
                                                        >性別</label
                                                    >
                                                    <div
                                                        class="flex items-center mt-2"
                                                    >
                                                        <input
                                                            type="radio"
                                                            id="gender_1"
                                                            name="gender"
                                                            v-model="
                                                                form.gender
                                                            "
                                                            value="0"
                                                            class="w-4 h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500"
                                                        />
                                                        <label
                                                            for="gender_1"
                                                            class="ml-2 text-sm font-medium text-gray-600"
                                                        >
                                                            男性
                                                        </label>
                                                    </div>
                                                    <div
                                                        class="flex items-center mt-2"
                                                    >
                                                        <input
                                                            type="radio"
                                                            id="gender_2"
                                                            name="gender"
                                                            v-model="
                                                                form.gender
                                                            "
                                                            value="1"
                                                            class="w-4 h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500"
                                                        />
                                                        <label
                                                            for="gender_2"
                                                            class="ml-2 text-sm font-medium text-gray-600"
                                                        >
                                                            女性
                                                        </label>
                                                    </div>
                                                    <div
                                                        class="flex items-center mt-2"
                                                    >
                                                        <input
                                                            type="radio"
                                                            id="gender_3"
                                                            name="gender"
                                                            v-model="
                                                                form.gender
                                                            "
                                                            value="2"
                                                            class="w-4 h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500"
                                                        />
                                                        <label
                                                            for="gender_3"
                                                            class="ml-2 text-sm font-medium text-gray-600"
                                                        >
                                                            その他
                                                        </label>
                                                    </div>
                                                    <div
                                                        v-if="errors.gender"
                                                        class="mt-2 text-red-400"
                                                    >
                                                        {{ errors.gender }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="w-full p-2">
                                                <div class="relative">
                                                    <label
                                                        for="usermemo"
                                                        class="text-sm leading-7 text-gray-600"
                                                        >説明</label
                                                    >
                                                    <textarea
                                                        type="text"
                                                        id="usermemo"
                                                        name="usermemo"
                                                        v-model="form.usermemo"
                                                        class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-gray-100 bg-opacity-50 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200"
                                                    />
                                                    <div
                                                        v-if="errors.usermemo"
                                                        class="mt-2 text-red-400"
                                                    >
                                                        {{ errors.usermemo }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="w-full p-2">
                                                <button
                                                    class="flex px-8 py-2 mx-auto text-lg text-white bg-indigo-500 border-0 rounded focus:outline-none hover:bg-indigo-600"
                                                >
                                                    顧客登録
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
