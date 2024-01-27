<script setup>
import AppLayout from "@/layout/AppLayout.vue";
import {computed, ref} from "vue";
import PaginateService from "@/Services/PaginateService.js";

const props = defineProps({
    device: Object,
    backups: Object,
})
const device = computed( () => props.device.data )

// const onRowExpand = (event) => {
//     toast.add({ severity: 'info', summary: 'Product Expanded', detail: event.data.name, life: 3000 });
// };
// const onRowCollapse = (event) => {
//     toast.add({ severity: 'success', summary: 'Product Collapsed', detail: event.data.name, life: 3000 });
// };

const expandedRows = ref([]);

const backupsPaginateService = PaginateService
    .create()
    .setPageName('backupsPage')
    .loadByPropName('backups')

</script>

<template>
    <AppLayout>
        <div class="grid">
            <div class="col-12">
                <div class="card flex justify-content-center ">

                    <h3 class="mt-2">{{ device.name }}</h3>
                </div>
            </div>
            <div class="col-12 lg:col-6">
                <div class="card mb-0">
                    <div class="flex justify-content-between mb-3">
                        <div>
                            <span class="block text-500 font-medium mb-3">Ostatni backup</span>
                            <div class="text-900 font-medium text-xl">{{ device.lastBackupDate }} </div>
                        </div>
                        <div class="flex align-items-center justify-content-center bg-blue-100 border-round"
                             style="width: 2.5rem; height: 2.5rem">
                            <i class="pi pi-calendar text-black text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 lg:col-6 ">
                <div class="card mb-0">
                    <div class="flex justify-content-between mb-3">
                        <div>
                            <span class="block text-500 font-medium mb-3">Następny backup</span>
                            <div class="text-900 font-medium text-xl"> {{ device.nextBackupDate }} </div>
                        </div>
                        <div class="flex align-items-center justify-content-center bg-blue-100 border-round"
                             style="width: 2.5rem; height: 2.5rem">
                            <i class="pi pi-calendar text-black text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 lg:col-6 xl:col-4">
                <div class="card mb-0">
                    <div class="flex justify-content-between mb-3">
                        <div>
                            <span class="block text-500 font-medium mb-3">Aktywne Backup'y</span>
                            <div class="text-900 font-medium text-xl">{{ device.backupsInProgressCount}} </div>
                        </div>
                        <div class="flex align-items-center justify-content-center bg-blue-100 border-round"
                             style="width: 2.5rem; height: 2.5rem">
                            <i class="pi pi-play text-black text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 lg:col-6 xl:col-4">
                <div class="card mb-0">
                    <div class="flex justify-content-between mb-3">
                        <div>
                            <span class="block text-500 font-medium mb-3">Ukończone</span>
                            <div class="text-900 font-medium text-xl">{{ device.backupsSuccessCount}} </div>
                        </div>
                        <div class="flex align-items-center justify-content-center bg-green-100 border-round"
                             style="width: 2.5rem; height: 2.5rem">
                            <i class="pi pi-check text-black-500 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 lg:col-6 xl:col-4">
                <div class="card mb-0">
                    <div class="flex justify-content-between mb-3">
                        <div>
                            <span class="block text-500 font-medium mb-3">Błędy</span>
                            <div class="text-900 font-medium text-xl">{{ device.backupsFailCount}} </div>
                        </div>
                        <div class="flex align-items-center justify-content-center bg-red-400 border-round"
                             style="width: 2.5rem; height: 2.5rem">
                            <i class="pi pi-times text-black-500 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <h5>Lista backupów tego urządzenia</h5>
                        <DataTable
                            v-model:expandedRows="expandedRows"
                           :value="backups.data"
                           tableStyle="min-width: 60rem"
                           paginator
                           lazy
                           :rows="backupsPaginateService.rows"
                           :total-records="backupsPaginateService.meta.total"
                           @page="(page) => backupsPaginateService.changePage(page)"
                            :loading="backupsPaginateService.duringLoading()"
                           :pt="backupsPaginateService.ptAttributes()"
                        >
                        <Column expander style="width: 5%" />
                        <Column field="backup_file_name" header="Nazwa pliku backup'u" :sortable="true" style="width: 15%" />
                        <Column field="created_at" header="Data utworzenia" :sortable="true" style="width: 20%" />
                        <Column field="status" header="Status" :sortable="true" style="width: 15%" />
                        <Column field="size" header="Rozmiar" :sortable="true" style="width: 15%" />
                        <Column field="error_message" header="Error" :sortable="true" style="width: 15%" />
                        <template #expansion="slotProps">
                            <div>
                                <DataTable :rowHover="true" :stripedRows="true" :value="slotProps.data.backup_table">
                                    <Column field="name" header="Name" style="width: 20%"></Column>
                                    <Column field="size" header="Size"></Column>
                                    <Column field="progress" header="Postęp Kopiowania">
                                        <template #body="{ data }">
                                            <b v-if="data.progress != null"> {{ data.progress }}% </b>
                                            <span v-else> Brak danych </span>
                                        </template>
                                    </Column>
                                </DataTable>
                            </div>
                        </template>
                    </DataTable>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
