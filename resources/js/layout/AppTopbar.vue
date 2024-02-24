<script setup>
import {ref, onMounted, onBeforeUnmount, computed} from 'vue';
import { useLayout } from '@/layout/composables/layout';
import AppSidebar from '@/layout/AppSidebar.vue';
import { usePrimeVue } from 'primevue/config';
import {Link, usePage} from '@inertiajs/vue3';
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";

const $primevue = usePrimeVue();

defineExpose({
    $primevue
});
const { isHorizontal, onMenuToggle, showConfigSidebar, showSidebar } = useLayout();

const outsideClickListener = ref(null);
const topbarMenuActive = ref(false);
const authUser = computed(() => usePage().props.auth.user);

onMounted(() => {
    bindOutsideClickListener();
});

onBeforeUnmount(() => {
    unbindOutsideClickListener();
});

const bindOutsideClickListener = () => {
    if (!outsideClickListener.value) {
        outsideClickListener.value = (event) => {
            if (isOutsideClicked(event)) {
                topbarMenuActive.value = false;
            }
        };
        document.addEventListener('click', outsideClickListener.value);
    }
};
const unbindOutsideClickListener = () => {
    if (outsideClickListener.value) {
        document.removeEventListener('click', outsideClickListener);
        outsideClickListener.value = null;
    }
};
const isOutsideClicked = (event) => {
    if (!topbarMenuActive.value) return;

    const sidebarEl = document.querySelector('.layout-topbar-menu');
    const topbarEl = document.querySelector('.layout-topbar-menu-button');

    return !(sidebarEl.isSameNode(event.target) || sidebarEl.contains(event.target) || topbarEl.isSameNode(event.target) || topbarEl.contains(event.target));
};
const onMenuButtonClick = () => {
    onMenuToggle();
};

const onConfigButtonClick = () => {
    showConfigSidebar();
};
const onSidebarButtonClick = () => {
    showSidebar();
};
</script>

<template>
    <div class="layout-topbar">
        <div class="topbar-start">
            <Button ref="menubutton" type="button" class="topbar-menubutton p-link p-trigger transition-duration-300" @click="onMenuButtonClick()">
                <i class="pi pi-bars"></i>
            </Button>
        </div>
        <div class="layout-topbar-menu-section">
            <AppSidebar></AppSidebar>
        </div>
        <div class="topbar-end">
            <ul class="topbar-menu">

                <li class="topbar-item mr-5">
                    <a v-styleclass="{ selector: '@next', enterClass: 'hidden', enterActiveClass: 'px-scalein', leaveToClass: 'hidden', leaveActiveClass: 'px-fadeout', hideOnOutsideClick: 'true' }" v-ripple class="cursor-pointer text-xl">
                        {{authUser.name}}
                        <FontAwesomeIcon :icon="['fas', 'chevron-down']"></FontAwesomeIcon>
                    </a>
                    <ul :class="'topbar-menu active-topbar-menu p-4 w-15rem z-5 hidden'">
                        <li role="menuitem" class="m-0 mb-3">
                            <a
                                href="#"
                                class="flex align-items-center hover:text-primary-500 transition-duration-200"
                                v-styleclass="{ selector: '@grandparent', enterClass: 'hidden', enterActiveClass: 'px-scalein', leaveToClass: 'hidden', leaveActiveClass: 'px-fadeout', hideOnOutsideClick: 'true' }"
                            >
                                <i class="pi pi-fw pi-lock mr-2"></i>
                                <span>Privacy</span>
                            </a>
                        </li>
                        <li role="menuitem" class="m-0 mb-3">
                            <a
                                href="#"
                                class="flex align-items-center hover:text-primary-500 transition-duration-200"
                                v-styleclass="{ selector: '@grandparent', enterClass: 'hidden', enterActiveClass: 'px-scalein', leaveToClass: 'hidden', leaveActiveClass: 'px-fadeout', hideOnOutsideClick: 'true' }"
                            >
                                <i class="pi pi-fw pi-cog mr-2"></i>
                                <span>Settings</span>
                            </a>
                        </li>
                        <li role="menuitem" class="m-0">
                            <a
                                href="#"
                                class="flex align-items-center hover:text-primary-500 transition-duration-200"
                                v-styleclass="{ selector: '@grandparent', enterClass: 'hidden', enterActiveClass: 'px-scalein', leaveToClass: 'hidden', leaveActiveClass: 'px-fadeout', hideOnOutsideClick: 'true' }"
                            >
                                <i class="pi pi-fw pi-sign-out mr-2"></i>
                                <span>
                                    <Link
                                    :href="route('logout')"
                                    method="post">
                                    Logout
                                    </Link> </span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</template>
