<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

const emit = defineEmits(['showAlert'])

const props = defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
    dataMember: {
        type: Object,
    }
});

const name = ref(props.dataMember ? props.dataMember.name : '');
const email = ref(props.dataMember ? props.dataMember.email : '');
const phone = ref(props.dataMember ? props.dataMember.phone : '');
const address = ref(props.dataMember ? props.dataMember.address : '');
const formErrors = ref({});

const createMember = async () => {
    try {
    const { data } = await axios.post('/api/member', {
        name: name.value,
        phone: phone.value,
        address: address.value,
        email: email.value
    });
        name.value = '';
        email.value = '';
        phone.value = '';
        address.value = '';
        formErrors.value = {};
        emit('showAlert', data)
    } catch (error) {
        formErrors.value = error.response.data.errors
        emit('showAlert', error.response.data)
    }
}
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Add Library Member</h2>
        </header>

        <form @submit.prevent="createMember" class="mt-6 space-y-6">
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="name"
                    required
                    autofocus
                />

                <InputError v-for="error in formErrors.name" class="mt-2" :message="error" />

            </div>

            <div>
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="email"
                    required
                />

                <InputError v-for="error in formErrors.email" class="mt-2" :message="error" />
            </div>

            <div>
                <InputLabel for="phone" value="Phone" />

                <TextInput
                    id="phone"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="phone"
                    required
                />

                <InputError v-for="error in formErrors.phone" class="mt-2" :message="error" />
            </div>

            <div>
                <InputLabel for="address" value="Address" />

                <TextInput
                    id="address"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="address"
                    required
                />

                <InputError v-for="error in formErrors.address" class="mt-2" :message="error" />
            </div>

            <div class="flex items-center gap-4">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Member</button>
                <Link
                    :href="route('member.index')"
                ><button class="bg-gray-400 text-white font-bold py-2 px-4 rounded">Cancel</button></Link>
            </div>
        </form>
    </section>
</template>
