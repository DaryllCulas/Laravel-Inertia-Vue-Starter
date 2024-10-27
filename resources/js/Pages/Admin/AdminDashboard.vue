<script setup>
import PaginationLinks from "../../Components/PaginationLinks.vue";
import RoleSelect from "../../Components/RoleSelect.vue";
import SessionMessages from "../../Components/SessionMessages.vue";
import InputField from "../../Components/InputField.vue";
import { router, useForm } from "@inertiajs/vue3";

defineProps({
  users: Object,
  status: String,
});

const params = route().params;

const form = useForm({
  search: params.search,
});

const search = () => {
  router.get(route("admin.index"), {
    search: form.search,
  });
};
</script>
<template>
  <Head title="- Admin" />

  <SessionMessages :statusMessage="status" />

  <!-- Heading -->
  <div class="flex items-end justify-between mb-4">
    <div class="flex items-end gap-2">
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
        :href="route('admin.index', { ...params, search: null, page: null })"
        >{{ params.search }}

        <i class="fa-solid fa-xmark"></i>
      </Link>
    </div>
  </div>

  <!-- Table -->
  <table
    class="bg-white dark:bg-slate-800 w-full rounded-lg overflow-hidden ring-1 ring-slate-300"
  >
    <thead>
      <tr class="bg-slate-600 text-slate-300 uppercase text-xs text-left">
        <th class="w-3/6">Name</th>
        <th class="w-2/6">Role</th>
        <th class="w-1/6">Listings</th>
        <th class="w-1/6">View</th>
      </tr>
    </thead>
    <tbody class="divide-y divide-slate-300 divide-dashed">
      <tr v-for="user in users.data" :key="user.id">
        <td class="w-3/6 py-5 px-3">
          <p class="font-bold mb-1">{{ user.name }}</p>
          <p class="font-light text-xs">{{ user.email }}</p>
        </td>
        <td class="w-2/6 py-5 px-3">
          <RoleSelect :user="user" />
        </td>
        <td class="w-1/6 py-5 px-3">
          <div class="flex items-center gap-1">
            <p>{{ user.listings.filter((list) => list.approved).length }}</p>
            <i class="fa-solid fa-circle-check text-green-400"></i>
            <div class="flex items-center gap-1">
              <p>{{ user.listings.filter((list) => !list.approved).length }}</p>
              <i class="fa-solid fa-circle-xmark text-red-400"></i>
            </div>
          </div>
        </td>
        <td class="w-1/6 py-5 px-3 text-right">View Link</td>
      </tr>
    </tbody>
  </table>
  <div class="mt-6">
    <PaginationLinks :paginator="users" />
  </div>
</template>
