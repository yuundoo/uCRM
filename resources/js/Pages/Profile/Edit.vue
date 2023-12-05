<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import DeleteUserForm from "./Partials/DeleteUserForm.vue";
import UpdatePasswordForm from "./Partials/UpdatePasswordForm.vue";
import { Head } from "@inertiajs/vue3";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { reactive } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
const props = defineProps({
    customer: Object,
    errors: Object,
});

const form = reactive({
    username: props.customer.username,
    email: props.customer.email,
});
</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                プロフィール
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
                <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                プロフィール情報
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                アカウントやメールアップデートすることができます。
                            </p>
                        </header>

                        <form
                            @submit.prevent="
                                form.patch(route('profile.update'))
                            "
                            class="mt-6 space-y-6"
                        >
                            <div>
                                <InputLabel for="username" value="ユーザー" />

                                <TextInput
                                    id="username"
                                    type="text"
                                    class="block w-full mt-1"
                                    v-model="form.username"
                                    required
                                    autofocus
                                    autocomplete="username"
                                />
                                <div
                                    v-if="errors.username"
                                    class="mt-2 text-red-400"
                                >
                                    {{ errors.username }}
                                </div>
                            </div>

                            <div>
                                <InputLabel for="email" value="メール" />

                                <TextInput
                                    id="email"
                                    type="email"
                                    class="block w-full mt-1"
                                    v-model="form.email"
                                    required
                                    autocomplete="username"
                                />
                                <div
                                    v-if="props.errors.email"
                                    class="mt-2 text-red-400"
                                >
                                    {{ errors.email }}
                                </div>
                            </div>

                            <div
                                v-if="
                                    props.mustVerifyEmail &&
                                    user.email_verified_at === null
                                "
                            >
                                <p class="mt-2 text-sm text-gray-800">
                                    Your email address is unverified.
                                    <Link
                                        :href="route('verification.send')"
                                        method="post"
                                        as="button"
                                        class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                    >
                                        Click here to re-send the verification
                                        email.
                                    </Link>
                                </p>

                                <!-- <div
                                    v-show="
                                        props.status ===
                                        'verification-link-sent'
                                    "
                                    class="mt-2 text-sm font-medium text-green-600"
                                >
                                    A new verification link has been sent to
                                    your email address.
                                </div> -->
                            </div>

                            <div class="flex items-center gap-4">
                                <PrimaryButton :disabled="form.processing"
                                    >Save</PrimaryButton
                                >

                                <Transition
                                    enter-from-class="opacity-0"
                                    leave-to-class="opacity-0"
                                    class="transition ease-in-out"
                                >
                                    <p
                                        v-if="form.recentlySuccessful"
                                        class="text-sm text-gray-600"
                                    >
                                        Saved.
                                    </p>
                                </Transition>
                            </div>
                        </form>
                    </section>
                </div>

                <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                    <UpdatePasswordForm class="max-w-xl" />
                </div>

                <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                    <DeleteUserForm class="max-w-xl" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
