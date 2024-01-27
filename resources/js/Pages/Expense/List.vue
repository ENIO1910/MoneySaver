<script setup>
import AppLayout from "@/layout/AppLayout.vue";
import {Link} from "@inertiajs/vue3";

const props = defineProps({
    expenses: Object,
})


</script>
<template>
    <AppLayout>
        <div class="grid">
            <div class="col-12">
                <div class="card">
                    <div class="flex justify-content-between">
                        <h4 class="m-0"> Dodaj wydatek </h4>
                        <Link
                            :href="route('expenses.create')"
                            class=""
                        >
                            <Button class="m-0" icon="pi pi-plus" rounded label="Dodaj wydatek" />
                        </Link>
                    </div>
                </div>
                <div class="card">
                    <h5>Historia wydatków</h5>
                    <DataTable :value="expenses.data" responsiveLayout="scroll">
                        <Column field="id" header="#" sortable style="width: 5%"></Column>
                        <Column field="money" header="Wydatek" sortable style="width: 20%"></Column>
                        <Column field="category" header="Kategoria" sortable style="width: 20%"></Column>
                        <Column field="created_at" header="Data" sortable style="width: 15%"></Column>
                        <Column header="Akcja" style="width: 20%">
                            <template #body="{data}">
                                <div class="flex flex-wrap gap-2">
                                    <a href="">
                                        <Button icon="pi pi-pencil" severity="success" text raised class="text-blue-500" rounded aria-label="Bookmark" />
                                    </a>
                                    <a href="" class="ml-5">
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
