<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { Inertia } from "@inertiajs/inertia";

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    Inertia.post("/login", form);
};
</script>

<template>
    <div
        class="flex items-center justify-center min-h-screen bg-gray-100"
        :style="{
            backgroundImage: 'url(/images/login.jpg)',
            backgroundPosition: 'center center',
            backgroundSize: 'cover',
        }"
    >
        <!-- 로그인 폼 컨테이너 -->
        <div class="w-full max-w-md px-8 py-6 bg-white rounded-lg shadow-md">
            <form @submit.prevent="submit" class="space-y-6">
                <div>
                    <div class="flex justify-center">
                        <Link href="/">
                            <ApplicationLogo
                                class="w-20 h-20 text-gray-500 fill-current"
                            />
                        </Link>
                    </div>
                    <InputLabel for="email" value="Email" />
                    <TextInput
                        id="email"
                        type="email"
                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        v-model="form.email"
                        required
                        autofocus
                    />
                    <InputError :message="form.errors.email" />
                </div>

                <div>
                    <InputLabel for="password" value="Password" />
                    <TextInput
                        id="password"
                        type="password"
                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        v-model="form.password"
                        required
                    />
                    <InputError :message="form.errors.password" />
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <Checkbox v-model:checked="form.remember" />
                        <span class="ml-2 text-sm text-gray-600"
                            >Remember me</span
                        >
                    </label>
                    <Link
                        :href="route('password.request')"
                        class="text-sm text-gray-600 underline hover:text-gray-900"
                    >
                        Forgot your password?
                    </Link>
                </div>

                <PrimaryButton class="w-full" :disabled="form.processing">
                    Log in
                </PrimaryButton>
            </form>
        </div>
    </div>
</template>
