<script setup>
import Container from "../../../Components/Container.vue";
import Title from "../../../Components/Title.vue";
import InputField from "../../../Components/InputField.vue";
import PrimaryBtn from "../../../Components/PrimaryBtn.vue";
import SessionMessages from "../../../Components/SessionMessages.vue";
import ErrorMessages from "../../../Components/ErrorMessages.vue";
import { useForm } from "@inertiajs/vue3";

const form = useForm({
  current_password: "",
  password: "",
  password_confirmation: "",
});

const submit = () => {
  form.put(route("profile.password"), {
    onSuccess: () => form.reset(),
    onError: () => form.reset(),
    preserveScroll: true,
  });
};
</script>
<template>
  <Container class="mb-6">
    <div class="mb-6">
      <Title>Update Password</Title>
      <p>Ensure you are using a long, random password to stay secure.</p>
    </div>

    <form class="space-y-6" @submit.prevent="submit">
      <InputField
        label="Current Password"
        icon="key"
        class="w-1/2"
        type="password"
        v-model="form.current_password"
      />

      <InputField
        label="New Password"
        icon="key"
        class="w-1/2"
        type="password"
        v-model="form.password"
      />

      <InputField
        label="Confirm Password"
        icon="key"
        class="w-1/2"
        type="password"
        v-model="form.password_confirmation"
      />

      <ErrorMessages :errors="form.errors" />

      <p v-if="form.recentlySuccessful" class="text-green-600 font-medium">
        Your password has been updated.
      </p>

      <PrimaryBtn :disabled="form.processing"> Save </PrimaryBtn>
    </form>
  </Container>
</template>
