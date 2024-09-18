<script setup>
import Container from "../../Components/Container.vue";
import Title from "../../Components/Title.vue";
import TextLink from "../../Components/TextLink.vue";
import InputField from "../../Components/InputField.vue";
import PrimaryBtn from "../../Components/PrimaryBtn.vue";
</script>

<template>
  <Container class="w-1/2">
    <div class="mb-8 text-center">
      <Title>Register a new account</Title>
      <p>Already have an account? <TextLink routeName="home" label="Login" /></p>
    </div>
    <form class="space-y-6">
      <InputField label="Name" icon="id-badge" />
      <InputField label="Email" icon="at" type="email" />
      <InputField label="Password" icon="key" type="email" />
      <InputField label="Confirm Password" icon="key" type="password" />
      <p class="text-slate-500 text-sm dark:text-slate-400">
        By creating an account, you agree to our terms of service and Privacy Policy.
      </p>
      <PrimaryBtn>Register</PrimaryBtn>
    </form>
  </Container>
</template>
