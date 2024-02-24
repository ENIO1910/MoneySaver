<script setup>
import AppLayout from "@/layout/AppLayout.vue";
import {Link, router} from "@inertiajs/vue3";
import {ref} from "vue";
import DepositMoney from "@/Pages/Wallet/components/DepositMoney.vue";

const props = defineProps({
    wallets: Object,
})

const isDeleteDialogVisible = ref(false);

const modalVisible = ref(false);
const walletId = ref(null);
const openDepositMoney = (id) => {
    walletId.value = id
    modalVisible.value = true;
};


const deletedItemId = ref(null);
const showDeleteDialog = (id) => {
    deletedItemId.value = id;
    isDeleteDialogVisible.value = true;
};


</script>
<template>
    <AppLayout>
        <div class="grid">
            <div class="col-12">
                <div class="card">
                    <Dialog v-model:visible="isDeleteDialogVisible" modal header="Usuń portfel" :style="{ width: '25rem' }">
                        <p>Na pewno chcesz kontynuować?</p>
                        <div class="flex justify-content-between mt-5 mx-2">
                            <Button label="Wróć" @click="isDeleteDialogVisible = false" />
                            <Link :href="route('wallets.destroy', {'id': deletedItemId})" method="delete">
                                <Button label="Usuń" icon="pi pi-trash" @click="isDeleteDialogVisible = false" class="p-button-danger"/>
                            </Link>
                        </div>
                    </Dialog>
                    <DepositMoney v-model:active="modalVisible" :walletId="walletId" />

                    <div class="flex justify-content-between">
                        <h4 class="m-0"> Dodaj nowy portfel</h4>
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
                                    <Button label="Wpłać" icon="pi pi-dollar" @click="openDepositMoney(data.id)" class="p-button-info mr-5"></Button>
                                    <Button icon="pi pi-trash" text raised class="text-red-500" @click="showDeleteDialog(data.id)" rounded aria-label="Trash" />
                                </div>
                            </template>
                        </Column>
                    </DataTable>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
