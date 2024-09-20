<script setup>
import Container from "../../Components/Container.vue";
import InputField from "../../Components/InputField.vue";
import PrimaryBtn from "../../Components/PrimaryBtn.vue";
import SessionMessages from "../../Components/SessionMessages.vue";
import ErrorMessages from "../../Components/ErrorMessages.vue";
import { useForm } from "@inertiajs/vue3";

defineProps({
  status: String,
});

const form = useForm({
  email: "",
});

// TODO: Apply Toast when the registration is successful
const submit = () => {
  form.post(route("password.email"));
};
</script>

<template>
  <Head title="- Forgot Password" />
  <Container class="w-1/2">
    <div class="mb-8 text-center">
      <p>
        Forgot your password? No worries, let's get you a new one. Just let us know your
        email address and we will email you a password reset link that will allow you to
        choose one
      </p>
    </div>

    <form @submit.prevent="submit" class="space-y-6">
      <InputField label="Email" icon="at" v-model="form.email" />

      <!-- Errors messages -->
      <ErrorMessages :errors="form.errors" />

      <!-- Session messages -->
      <SessionMessages :statusMessage="status" />
      <PrimaryBtn :disabled="form.processing">Send Password Reset Link</PrimaryBtn>
    </form>
  </Container>
</template>
