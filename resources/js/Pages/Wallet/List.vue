<script setup>
import AppLayout from "@/layout/AppLayout.vue";
import {Link} from "@inertiajs/vue3";
import {ref} from "vue";

const props = defineProps({
    wallets: Object,
})

const items = ref([
    {
        label: 'Wypłać',
        icon: 'pi pi-minus',
    },
]);


</script>
<template>
    <AppLayout>
        <div class="grid">
            <div class="col-12">
                <div class="card">
                    <div class="flex justify-content-between">
                        <h4 class="m-0"> Dodaj nowy portfel </h4>
                        <Link
                            :href="route('wallets.create')"
                        >
                            <Button class="m-0" icon="pi pi-plus" rounded label="Dodaj portfel" />
                        </Link>
                    </div>
                </div>
                <div class="card">
                    <h5>Aktualne portfele użytkownika</h5>
                    <DataTable :value="wallets.data" responsiveLayout="scroll">
                        <Column field="id" header="#" sortable style="width: 5%"></Column>
                        <Column field="money" header="Stan konta" sortable style="width: 20%"></Column>
                        <Column field="name" header="Nazwa" sortable style="width: 20%"></Column>
                        <Column field="created_at" header="Data" sortable style="width: 15%"></Column>
                        <Column header="Akcja" style="width: 20%">
                            <template #body="{data}">
                                <div class="flex flex-wrap gap-2">
                                    <SplitButton label="Wpłać" icon="pi pi-dollar" :model="items" class="p-button-info mr-5"></SplitButton>
                                    <a href="">
                                        <Button icon="pi pi-trash" text raised class="text-red-500" rounded aria-label="Bookmark" />
                                    </a>
                                </div>
                            </template>
                        </Column>
                    </DataTable>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
