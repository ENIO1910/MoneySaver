<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';
import AppConfig from "@/layout/AppConfig.vue";

defineProps<{
    status?: string;
}>();

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <div class="surface-0">
        <div class="flex align-items-center justify-content-between flex-column h-screen">
            <div
                class="flex flex-column align-items-center justify-content-center w-full md:w-4 h-full text-center py-6 px-4">
                <a class="mb-6" style="cursor: pointer">
                    <svg height="56" viewBox="0 0 17 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M0 0H6.00019V3.82345L17 1.66667V6.66667L6.00019 8.82345V10.4901L17 8.33333V13.3333L6.00019 15.4901V20H0V0Z"
                            fill="url(#paint0_linear)"/>
                        <defs>
                            <linearGradient id="paint0_linear" x1="3.33335" y1="3.08442e-08" x2="8.49995" y2="20"
                                            gradientUnits="userSpaceOnUse">
                                <stop stop-color="var(--primary-400)"/>
                                <stop offset="1" stop-color="var(--primary-700)"/>
                            </linearGradient>
                        </defs>
                    </svg>
                </a>
                <div class="mb-4">
                    <div class="text-900 text-xl font-bold mb-2">Register</div>
                    <span class="text-600 font-medium">Let's get started</span>
                </div>
                <div class="flex flex-column">
                    <span class="p-input-icon-left w-full mb-4">
                        <i class="pi pi-envelope"></i>
                        <InputText v-model="form.email" id="email" type="text" class="w-full md:w-25rem text-color-secondary surface-50 border-200" placeholder="Email" />
                    </span>
                    <InputError class="mt-2" :message="form.errors.email"/>

                    <Button class="w-full mb-4 justify-content-center" :disabled="form.processing">
                        Email Password Reset Link
                    </Button>
                    <span class="font-medium text-600">Already have an account?<Link
                        class="font-semibold cursor-pointer text-900 hover:text-primary transition-colors transition-duration-300"
                        :href="route('login')"> Login </Link></span>
                </div>
            </div>
            <div class="flex flex-wrap align-items-center pb-8 px-4">
                <h4 class="m-0 mr-5" style="line-height: 22px">freya</h4>
                <h6 class="m-0 font-medium text-300" style="line-height: 17px">Copyright Ⓒ PrimeTek Informatics</h6>
            </div>
        </div>
    </div>

    <AppConfig simple/>
</template>

<!--<template>-->

<!--    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">-->
<!--        Forgot your password? No problem. Just let us know your email address and we will email you a password reset-->
<!--        link that will allow you to choose a new one.-->
<!--    </div>-->

<!--    <div v-if="status" class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">-->
<!--        {{ status }}-->
<!--    </div>-->

<!--    <form @submit.prevent="submit">-->
<!--        <div>-->
<!--            <InputLabel for="email" value="Email"/>-->

<!--            <TextInput-->
<!--                id="email"-->
<!--                type="email"-->
<!--                class="mt-1 block w-full"-->
<!--                v-model="form.email"-->
<!--                required-->
<!--                autofocus-->
<!--                autocomplete="username"-->
<!--            />-->

<!--            <InputError class="mt-2" :message="form.errors.email"/>-->
<!--        </div>-->

<!--        <div class="flex items-center justify-end mt-4">-->
<!--            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">-->
<!--                Email Password Reset Link-->
<!--            </PrimaryButton>-->
<!--        </div>-->
<!--    </form>-->
<!--</template>-->
