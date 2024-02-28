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

const memberId = ref(props.dataMember ? props.dataMember.id : '');
const name = ref(props.dataMember ? props.dataMember.name : '');
const email = ref(props.dataMember ? props.dataMember.email : '');
const phone = ref(props.dataMember ? props.dataMember.phone : '');
const address = ref(props.dataMember ? props.dataMember.address : '');

const updateMember = async () => {
    try {
    const { data } = await axios.put('/api/member/' + memberId.value, {
        name: name.value,
        phone: phone.value,
        address: address.value,
        email: email.value
    });
        emit('showAlert', data)
    } catch (error) {
        emit('showAlert', error.response.data)
    }
}
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Update Library Member</h2>
        </header>

        <form @submit.prevent="updateMember" class="mt-6 space-y-6">
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
            </div>

            <div class="flex items-center gap-4">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Member</button>
                <Link
                    :href="route('member.index')"
                ><button class="bg-gray-400 text-white font-bold py-2 px-4 rounded">Cancel</button></Link>
            </div>
        </form>
    </section>
</template>
