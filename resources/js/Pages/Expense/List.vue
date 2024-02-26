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
                        <Column field="money" header="Wydatek" sortable style="width: 10%">
                            <template #body="{data}">
                                <Badge class="w-full" style="background: linear-gradient(90deg, #ce389d 0%, #ce3131 100%)" >
                                    <span class="text-lg text-white">
                                    {{data.money}}
                                </span>
                                </Badge>
                            </template>
                        </Column>
                        <Column field="category" header="Kategoria" sortable style="width: 20%"></Column>
                        <Column field="wallet.name" header="Konto" sortable style="width: 15%"></Column>
                        <Column field="wallet.money" header="Stan konta" sortable style="width: 10%">
                            <template #body="{data}">
                                <Badge class="w-full" style="background: linear-gradient(90deg, #ce389d 0%, #ce3131 100%)" >
                                    <span class="text-lg text-white">
                                    {{data.wallet.money}}
                                </span>
                                </Badge>
                            </template>
                        </Column>
                        <Column field="created_at" header="Data" sortable style="width: 15%">
                            <template #body="{data}">
                                <span class="flex w-full justify-content-center">
                                    {{data.created_at}}
                                </span>
                            </template>
                        </Column>
                        <Column header="Akcja" style="width: 20%">
                            <template #body="{data}">
                                <div class="flex flex-wrap gap-2">
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
