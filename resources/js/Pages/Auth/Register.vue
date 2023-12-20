<script setup>
import { Core as YubinBangoCore } from "yubinbango-core2";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { reactive } from "vue";
import { Head } from "@inertiajs/vue3";
import { Inertia } from "@inertiajs/inertia";

defineProps({ errors: Object });

const form = reactive({
    username: null,
    kana: null,
    tel: null,
    email: null,
    password: null,
    password_confirmation: null,
    postcode: null,
    address: null,
    birthday: null,
    gender: null,
    usermemo: null,
});

const registerCustomer = () => {
    Inertia.post("/register", form);
};

const fetchAddress = () => {
    new YubinBangoCore(String(form.postcode), (value) => {
        form.address = value.region + value.locality + value.street;
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="お客登録" />

        <div class="py-12">
            <div
                class="max-w-md mx-auto overflow-hidden bg-white rounded-lg shadow-md"
            >
                <div class="p-6">
                    <section class="text-gray-600 body-font">
                        <form
                            @submit.prevent="registerCustomer"
                            class="space-y-6"
                        >
                            <div class="text-center">
                                <h2
                                    class="text-xl font-semibold leading-tight text-gray-800"
                                >
                                    お客登録
                                </h2>
                            </div>

                            <!-- 사용자 이름 입력 필드 -->
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
                                    class="w-full px-3 py-2 text-base leading-8 text-gray-700 bg-gray-100 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white"
                                />
                                <div
                                    v-if="errors.username"
                                    class="mt-1 text-xs text-red-500"
                                >
                                    {{ errors.username }}
                                </div>
                            </div>

                            <!-- 나머지 입력 필드들 -->
                            <!-- 예: 顧客名カナ -->
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
                                    class="w-full px-3 py-2 text-base leading-8 text-gray-700 bg-gray-100 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white"
                                />
                                <div
                                    v-if="errors.kana"
                                    class="mt-1 text-xs text-red-500"
                                >
                                    {{ errors.kana }}
                                </div>
                            </div>

                            <!-- 전화번호 필드 -->
                            <div class="relative">
                                <label
                                    for="tel"
                                    class="text-sm leading-7 text-gray-600"
                                    >電話番号</label
                                >
                                <input
                                    type="tel"
                                    id="tel"
                                    name="tel"
                                    v-model="form.tel"
                                    class="w-full px-3 py-2 text-base leading-8 text-gray-700 bg-gray-100 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white"
                                />
                                <div
                                    v-if="errors.tel"
                                    class="mt-1 text-xs text-red-500"
                                >
                                    {{ errors.tel }}
                                </div>
                            </div>

                            <!-- 이메일 필드 -->
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
                                    class="w-full px-3 py-2 text-base leading-8 text-gray-700 bg-gray-100 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white"
                                />
                                <div
                                    v-if="errors.email"
                                    class="mt-1 text-xs text-red-500"
                                >
                                    {{ errors.email }}
                                </div>
                            </div>

                            <!-- 비밀번호 필드 -->
                            <div class="relative">
                                <label
                                    for="password"
                                    class="text-sm leading-7 text-gray-600"
                                    >暗証番号</label
                                >
                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    v-model="form.password"
                                    class="w-full px-3 py-2 text-base leading-8 text-gray-700 bg-gray-100 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white"
                                />
                                <div
                                    v-if="errors.password"
                                    class="mt-1 text-xs text-red-500"
                                >
                                    {{ errors.password }}
                                </div>
                            </div>

                            <!-- 비밀번호 확인 필드 -->
                            <div class="relative">
                                <label
                                    for="password_confirmation"
                                    class="text-sm leading-7 text-gray-600"
                                    >暗証番号確認</label
                                >
                                <input
                                    type="password"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    v-model="form.password_confirmation"
                                    class="w-full px-3 py-2 text-base leading-8 text-gray-700 bg-gray-100 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white"
                                />
                                <div
                                    v-if="errors.password_confirmation"
                                    class="mt-1 text-xs text-red-500"
                                >
                                    {{ errors.password_confirmation }}
                                </div>
                            </div>

                            <!-- 우편번호 필드 -->
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
                                    class="w-full px-3 py-2 text-base leading-8 text-gray-700 bg-gray-100 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white"
                                />
                                <div
                                    v-if="errors.postcode"
                                    class="mt-1 text-xs text-red-500"
                                >
                                    {{ errors.postcode }}
                                </div>
                            </div>

                            <!-- 주소 필드 -->
                            <div class="relative">
                                <label
                                    for="address"
                                    class="text-sm leading-7 text-gray-600"
                                    >住所</label
                                >
                                <input
                                    type="text"
                                    id="address"
                                    name="address"
                                    v-model="form.address"
                                    class="w-full px-3 py-2 text-base leading-8 text-gray-700 bg-gray-100 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white"
                                />
                                <div
                                    v-if="errors.address"
                                    class="mt-1 text-xs text-red-500"
                                >
                                    {{ errors.address }}
                                </div>
                            </div>

                            <!-- 생년월일 필드 -->
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
                                    class="w-full px-3 py-2 text-base leading-8 text-gray-700 bg-gray-100 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white"
                                />
                                <div
                                    v-if="errors.birthday"
                                    class="mt-1 text-xs text-red-500"
                                >
                                    {{ errors.birthday }}
                                </div>
                            </div>

                            <!-- 성별 필드 -->
                            <div class="relative">
                                <label class="text-sm leading-7 text-gray-600"
                                    >性別</label
                                >
                                <div class="flex items-center mt-2">
                                    <input
                                        type="radio"
                                        id="gender_male"
                                        name="gender"
                                        v-model="form.gender"
                                        value="0"
                                        class="w-4 h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500"
                                    />
                                    <label
                                        for="gender_male"
                                        class="ml-2 text-sm text-gray-600"
                                        >男性</label
                                    >
                                </div>
                                <div class="flex items-center mt-2">
                                    <input
                                        type="radio"
                                        id="gender_female"
                                        name="gender"
                                        v-model="form.gender"
                                        value="1"
                                        class="w-4 h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500"
                                    />
                                    <label
                                        for="gender_female"
                                        class="ml-2 text-sm text-gray-600"
                                        >女性</label
                                    >
                                </div>
                                <div class="flex items-center mt-2">
                                    <input
                                        type="radio"
                                        id="gender_other"
                                        name="gender"
                                        v-model="form.gender"
                                        value="2"
                                        class="w-4 h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500"
                                    />
                                    <label
                                        for="gender_other"
                                        class="ml-2 text-sm text-gray-600"
                                        >その他</label
                                    >
                                </div>
                                <div
                                    v-if="errors.gender"
                                    class="mt-1 text-xs text-red-500"
                                >
                                    {{ errors.gender }}
                                </div>
                            </div>

                            <!-- 메모 필드 -->
                            <div class="relative">
                                <label
                                    for="usermemo"
                                    class="text-sm leading-7 text-gray-600"
                                    >メモ</label
                                >
                                <textarea
                                    id="usermemo"
                                    name="usermemo"
                                    v-model="form.usermemo"
                                    class="w-full px-3 py-2 text-base leading-8 text-gray-700 bg-gray-100 border border-gray-300 rounded outline-none focus:border-indigo-500 focus:bg-white"
                                ></textarea>
                                <div
                                    v-if="errors.usermemo"
                                    class="mt-1 text-xs text-red-500"
                                >
                                    {{ errors.usermemo }}
                                </div>
                            </div>

                            <div class="text-center">
                                <button
                                    class="px-8 py-2 mt-4 text-lg text-white bg-indigo-500 border-0 rounded hover:bg-indigo-600 focus:outline-none"
                                >
                                    顧客登録
                                </button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
