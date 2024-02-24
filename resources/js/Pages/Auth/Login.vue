<script setup lang="ts">
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import AppConfig from '@/layout/AppConfig.vue';

defineProps<{
    canResetPassword?: boolean;
    status?: string;
}>();

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => {
            form.reset('password');
        },
    });
};
</script>

<template>
    <div class="surface-0">
        <div class="flex align-items-center justify-content-between flex-column h-screen">
            <div class="flex flex-column align-items-center justify-content-center w-full md:w-4 h-full text-center py-6 px-4">
                <a :href="route('dashboard')" class="mb-6" style="cursor: pointer">
                    <svg height="56" viewBox="0 0 17 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 0H6.00019V3.82345L17 1.66667V6.66667L6.00019 8.82345V10.4901L17 8.33333V13.3333L6.00019 15.4901V20H0V0Z" fill="url(#paint0_linear)" />
                        <defs>
                            <linearGradient id="paint0_linear" x1="3.33335" y1="3.08442e-08" x2="8.49995" y2="20" gradientUnits="userSpaceOnUse">
                                <stop stop-color="var(--primary-400)" />
                                <stop offset="1" stop-color="var(--primary-700)" />
                            </linearGradient>
                        </defs>
                    </svg>
                </a>
                <div class="flex flex-column">
                    <span class="mb-4">
                        <span class="p-input-icon-left w-full">
                            <i class="pi pi-envelope"></i>
                            <InputText v-model="form.email" id="email" type="text" class="w-full md:w-25rem text-color-secondary surface-50 border-200" placeholder="Email" />
                        </span>
                        <small class="text-red-600">{{form.errors.email}}</small>
                    </span>
                    <span class="mb-4">
                        <span class="p-input-icon-left w-full">
                            <i class="pi pi-lock"></i>
                            <InputText v-model="form.password" id="password" type="password" class="w-full md:w-25rem text-color-secondary surface-50 border-200" placeholder="Password" />
                        </span>
                        <small class="text-red-600">{{form.errors.password}}</small>
                    </span>
                    <Button @click="submit" label="Sign Up" class="w-full mb-4"></Button>
                    <a :href="route('password.request')" class="font-medium text-sm text-300">forget password?</a>
                    <p class="font-medium text-400 m-0 mt-6">Don’t you have an account, <Link class="font-semibold cursor-pointer text-900 hover:text-primary transition-colors transition-duration-300" :href="route('register')"> sing up </Link> </p>
                </div>
            </div>
            <div class="flex flex-wrap align-items-center pb-8 px-4">
                <h4 class="m-0 mr-5" style="line-height: 22px">freya</h4>
                <h6 class="m-0 font-medium text-300" style="line-height: 17px">Copyright Ⓒ PrimeTek Informatics</h6>
            </div>
        </div>
    </div>

    <AppConfig simple />
</template>
