<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
  password: '',
});

const confirmUserDeletion = () => {
  confirmingUserDeletion.value = true;

  nextTick(() => passwordInput.value.focus());
};

const deleteUser = () => {
  form.delete(route('profile.destroy'), {
    preserveScroll: true,
    onSuccess: () => closeModal(),
    onError: () => passwordInput.value.focus(),
    onFinish: () => form.reset(),
  });
};

const closeModal = () => {
  confirmingUserDeletion.value = false;

  form.reset();
};
</script>

<template>
  <section class="space-y-6">
    <header>
      <h2 class="pb-3 text-lg font-medium text-gray-900">アカウント削除</h2>

      <p class="mt-1 text-sm text-gray-600">アカウントが削除されると、そのすべてのリソースとデータが永久に削除されます。 削除する前にお客様のアカウントに保存したいデータまたは情報をダウンロードしてください。</p>
    </header>

    <DangerButton @click="confirmUserDeletion">アカウント削除</DangerButton>

    <Modal :show="confirmingUserDeletion" @close="closeModal">
      <div class="p-6">
        <h2 class="text-lg font-medium text-gray-900">お客様のアカウントを削除してもよろしでしょうか？</h2>

        <p class="mt-1 text-sm text-gray-600">アカウントが削除されると、そのすべてのリソースとデータが永久に削除されます。アカウントを完全に削除するには、パスワードを入力してください。</p>

        <div class="mt-6">
          <InputLabel for="password" value="Password" class="sr-only" />

          <TextInput id="password" ref="passwordInput" v-model="form.password" type="password" class="block w-3/4 mt-1" placeholder="Password" @keyup.enter="deleteUser" />

          <InputError :message="form.errors.password" class="mt-2" />
        </div>

        <div class="flex justify-end mt-6">
          <SecondaryButton @click="closeModal">取り消し</SecondaryButton>

          <DangerButton class="ml-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" @click="deleteUser">アカウント削除</DangerButton>
        </div>
      </div>
    </Modal>
  </section>
</template>
