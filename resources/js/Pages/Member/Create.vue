<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import FormCreateMember from './Partials/FormCreateMember.vue'
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

const alert = ref(false);
const alertMessage = ref('');
const alertType = ref('');

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const showAlert = (data) => {
    alert.value = true
    alertMessage.value = data.message
    alertType.value = data.status
}
</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Member</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div v-if="alert" class="py-5 px-5 rounded" :class="alertType == 'success' ? 'bg-green-500' : 'bg-red-500'">
                    <p class="text-white font-bold">{{ alertMessage }}</p>
                </div>  
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <FormCreateMember
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                        class="max-w-xl"
                        @show-alert="showAlert"
                    />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
