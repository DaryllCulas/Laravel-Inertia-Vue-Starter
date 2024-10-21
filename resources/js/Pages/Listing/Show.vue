<script setup>
import Container from "../../Components/Container.vue";

defineProps({
  listing: Object,
  user: Object,
});
</script>

<template>
  <Head title="- Listing Detail" />
  <Container class="flex gap-4">
    <div class="w-1/4 rounded-md overflow-hidden">
      <img
        :src="
          listing.image
            ? `/storage/${listing.image}`
            : '/storage/images/listing/default.png'
        "
        alt=""
        class="w-full h-full object-cover object-center"
      />
    </div>
    <div class="w-3/4">
      <!-- Listing info -->
      <div class="mb-6">
        <div class="flex items-end justify-between mb-2">
          <p class="text-slate-400 w-full border-b">Listing Detail</p>
          <div>Edit and Delete</div>
        </div>
        <h3 class="font-bold text-2xl mb-4">
          {{ listing.title }}
        </h3>
        <p>
          {{ listing.desc }}
        </p>
      </div>
      <!-- Contact Info -->
      <div class="mb-6">
        <p class="text-slate-400 w-full border-b mb-2">Contact Info</p>

        <!-- Email -->
        <div v-if="listing.email" class="flex items-center mb-2 gap-2">
          <i class="fa-solid fa-at"></i>
          <p>Email:</p>
          <a :href="`mailto:${listing.email}`" class="text-link">{{ listing.email }}</a>
        </div>

        <!-- Link -->
        <div v-if="listing.link" class="flex items-center mb-2 gap-2">
          <i class="fa-solid fa-up-right-from-square"></i>
          <p>External Link:</p>
          <a :href="listing.link" target="_blank" class="text-link">{{ listing.link }}</a>
        </div>
      </div>

      <!-- User -->
      <div class="flex items-center mb-2 gap-2">
        <i class="fa-solid fa-user"></i>
        <p>Listed By:</p>
        <Link :href="route('home', { user_id: user.id })" class="text-link">{{
          user.name
        }}</Link>
      </div>

      <!-- Tags -->
      <div v-if="listing.tags" class="mb-6">
        <p class="text-slate-400 w-full border-b mb-2">Tags</p>

        <div class="flex items-center gap-3">
          <div v-for="tag in listing.tags.split(',')" :key="tag">
            <Link
              :href="route('home', { tag })"
              class="bg-slate-500 text-white py-px px-2 rounded-full hover:bg-slate-700 dark:hover:bg-slate-900"
            >
              {{ tag }}
            </Link>
          </div>
        </div>
      </div>
    </div>
  </Container>
</template>
