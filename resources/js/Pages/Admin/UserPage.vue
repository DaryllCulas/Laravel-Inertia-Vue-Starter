<script setup>
import { router, useForm } from "@inertiajs/vue3";
import Title from "../../Components/Title.vue";
import InputField from "../../Components/InputField.vue";
import PaginationLinks from "../../Components/PaginationLinks.vue";

const props = defineProps({
  user: Object,
  listings: Object,
});

const params = route().params;
const form = useForm({
  search: params.search,
});

const search = () => {
  router.get(
    route("user.show", {
      user: props.user.id,
      search: form.search,
    })
  );
};
</script>

<template>
  <Head :title="`- ${user.name} Listings`" />

  <!-- Heading -->
  <div class="mb-6">
    <Title>{{ user.name }} latest listings</Title>
    <div class="flex items-end justify-between">
      <div class="flex items-end gap-2 mb-4">
        <!-- Search Form -->
        <form @submit.prevent="search">
          <InputField
            label=""
            icon="magnifying-glass"
            placeholder="Search..."
            v-model="form.search"
          />
        </form>
        <Link
          class="px-2 py-[6px] rounded-md bg-indigo-500 text-white flex items-center gap-2"
          v-if="params.search"
          :href="
            route('user.show', { ...params, search: null, page: null, user: user.id })
          "
          >{{ params.search }}

          <i class="fa-solid fa-xmark"></i>
        </Link>
      </div>
      <div>Toggle</div>
    </div>

    <!-- Table -->
    <table
      class="bg-white dark:bg-slate-800 w-full rounded-lg overflow-hidden ring-1 ring-slate-300"
    >
      <thead>
        <tr class="bg-slate-600 text-slate-300 uppercase text-xs text-left">
          <th class="w-4/6 p-3">Title</th>
          <th class="w-2/6 p-3 text-center">Approved</th>
          <th class="w-1/6 p-3 text-right">View</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-slate-300 divide-dashed">
        <tr v-for="listing in listings.data" :key="listing.id">
          <td class="py-5 px-3">{{ listing.title }}</td>
          <td class="py-5 px-3 text-2xl text-center">
            <button>
              <i
                :class="`fa-solid fa-${
                  listing.approved
                    ? 'circle-check text-green-400'
                    : 'circle-xmark text-red-400'
                }`"
              ></i>
            </button>
          </td>
          <td class="w-1/6 py-5 px-3 text-right">
            <Link
              :href="route('listing.show', listing.id)"
              class="fa-solid fa-up-right-from-square px-3 text-indigo-400"
            >
            </Link>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="mt-6">
    <PaginationLinks :paginator="listings" />
  </div>
</template>
