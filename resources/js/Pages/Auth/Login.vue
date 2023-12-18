<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />
        <template #log>

            <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                {{ status }}
            </div>
            <div v-if="$page.props.flash.success" id="flash-success-message" class="absolute top-20 right-1 p-4 bg-green-300 border border-gray-300 rounded-md shadow-md">
                {{ $page.props.flash.success }}
                <div class="progress-bar success"></div>
            </div>

            <div v-if="$page.props.flash.error" id="flash-error-message" class=" absolute top-20 right-1 p-4 bg-red-300 border border-gray-300 rounded-md shadow-md">
                {{ $page.props.flash.error }}
                <div class="progress-bar error"></div>
            </div>

            <div class="min-w-screen min-h-screen bg-gray-50 flex items-center justify-center px-5 py-5">
                <div class="bg-gray-100 text-gray-500 rounded-3xl shadow-xl w-full overflow-hidden" style="max-width:1000px">
                    <div class="md:flex w-full">
                        <div class="w-full md:w-1/2 flex justify-center items-center bg-green-500">
                            <img src="https://californiapayroll.com/wp-content/uploads/2022/01/payroll-banner-image.png">
                        </div>
                        <div class="w-full md:w-1/2 py-7 px-5 md:px-10">
                            <div class="text-center mb-10">
                                <h1 class="font-bold text-3xl text-gray-900">LOG IN</h1>
                                <p>Login to your account</p>

                            </div>
                            <form @submit.prevent="submit" >
                                <div>
                                    <InputLabel for="email" value="Email" />
                                    <TextInput
                                        id="email"
                                        v-model="form.email"
                                        type="email"
                                        class="mt-1 block w-full"
                                        required
                                        autofocus
                                        autocomplete="username"
                                    />
                                    <InputError class="mt-2" :message="form.errors.email" />
                                </div>

                                <div class="mt-4">
                                    <InputLabel for="password" value="Password" />
                                    <TextInput
                                        id="password"
                                        v-model="form.password"
                                        type="password"
                                        class="mt-1 block w-full"
                                        required
                                        autocomplete="current-password"
                                    />
                                    <InputError class="mt-2" :message="form.errors.password" />
                                </div>

                                <div class="mt-4">
                                    <button type="submit" class="w-full flex justify-center bg-green-500  hover:bg-green-600 text-gray-100 p-3  rounded-lg tracking-wide font-semibold  cursor-pointer transition ease-in duration-500 mb-4">
                                    Log in
                                </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </template>



    </GuestLayout>
</template>
