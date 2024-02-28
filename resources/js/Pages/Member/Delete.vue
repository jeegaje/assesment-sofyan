<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const alert = ref(false);
const alertMessage = ref('');
const alertType = ref('');

const showDelete = ref(true);

const props = defineProps({
    memberId: {
        type: Number,
    },
});

const showAlert = (data) => {
    alert.value = true
    alertMessage.value = data.message
    alertType.value = data.status
}

const deleteMember = async () => {
    try {
    const { data } = await axios.delete('/api/member/' + props.memberId);
        showAlert(data)
        showDelete.value = false
    } catch (error) {
        showAlert(error.response.data)
    }
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
                <div v-show="showDelete" class="p-4 sm:p-8 bg-white shadow sm:rounded-lg text-center">
                    <h2 class="text-lg font-medium text-gray-900">Delete Member</h2>
                    <p>Are you sure want to delete this member?</p>
                    
                    <button class="py-2 px-5 me-2 bg-red-500 rounded text-white font-bold" @click="deleteMember">
                        Delete Member
                    </button>
                    <Link class="py-2 px-5 me-2 bg-gray-500 rounded text-white font-bold" :href="route('member.index')">
                        Cancel
                    </Link>
                </div>
                <div class="flex items-center justify-center">
                    <Link v-show="!showDelete"  :href="route('member.index')">
                        <button class="py-2 px-5 my-5 bg-gray-500 rounded text-white font-bold">Back to Dashboard</button>
                    </Link>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
