<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const members = ref([]);

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

axios.get('/api/member').then(response => {
    members.value = response.data.data;
});
</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Member</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="relative overflow-x-auto">
                        <div class="flex justify-between items-center py-5">
                            <h2 class="px-5 text-lg font-bold text-gray-900">Library Member</h2>
                            <Link
                                :href="route('member.create')"
                            ><button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Member</button></Link>
                        </div>
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Member Name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Email
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Phone
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Address
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="bg-white border-b" v-for="(member,i) in members" :key="i">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            {{ member.name }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ member.email }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ member.phone }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ member.address }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <Link class="bg-blue-500 text-white py-2 px-3 me-2 rounded" :href="route('anggota.show', {'id': member.id})">View</Link>
                                            <Link class="bg-red-500 text-white py-2 px-3 rounded" :href="route('anggota.delete', {'id': member.id})">Delete</Link>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
