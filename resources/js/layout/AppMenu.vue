<script setup>
import { ref } from 'vue';
import AppMenuItem from './AppMenuItem.vue';

const model = ref([
    {
        icon: 'pi pi-home',
        items: [
            {
                label: 'Dashboard',
                url: route('dashboard'),
                icon: 'pi pi-fw pi-home',
            },
            {
                label: 'Wydatki',
                url: route('expenses.index'),
                icon: 'pi pi-fw pi-list',
            },
            {
                label: 'Portfele',
                url: route('wallets.index'),
                icon: 'pi pi-fw pi-list',
            },
        ]
    },
]);
</script>

<template>
    <ul class="layout-menu">
        <template v-for="(item, i) in model" :key="item">
            <AppMenuItem :item="item" root :index="i" />

            <li class="menu-separator"></li>
        </template>
    </ul>
</template>

<style lang="scss" scoped></style>
