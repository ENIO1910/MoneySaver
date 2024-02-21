<script setup>
import AppLayout from "@/layout/AppLayout.vue";
import { ref, computed } from 'vue';
import {useForm} from "@inertiajs/vue3";
import { useToast } from "primevue/usetoast";





const errors = ref({})

const form = useForm({
    name: null,
    money: null,

})
const toast = useToast();


const handleForm = () => {
    form.post(route('wallets.store'), {
        onSuccess: () => {
            form.money = null
            form.category = null
            toast.add({ severity: 'success', summary: 'Udało się dodać portfel', life: 3000 });
        },
        onError: () => {
            toast.add({ severity: 'warn', summary: 'Coś poszło nie tak', detail: 'Sprawdź formularz', life: 3000 });
        }
    });
}


</script>

<template>
    <AppLayout>
        <div class="grid">

            <div class="col-12">
                <div class="card">
                    <h1>Dodaj nowy portfel</h1>
                </div>
            </div>
            <div class="col-12">
                <div class="card mb-0">
                    <div class="flex flex-column justify-content-between mb-3">
                        <label for="name" class="block text-900 text-xl font-medium mb-2">Nazwa portfela</label>
                            <span class="p-input-icon-left">
                                <i class="pi pi-user" />
                                <InputText  type="text" :required="true" placeholder="Wpisz nazwę portfela" class="w-full md:w-30rem"   v-model="form.name" />
                            </span>
                        <small class="error">{{form.errors.name}}</small>

                        <label for="money" class="block text-900 text-xl font-medium mb-2 mt-2">Wartość portfela</label>
                        <InputNumber id="money" ico type="text" :required="true" placeholder="Wpisz stan portfela" class="w-full md:w-30rem" inputClass="w-full" v-model="form.money" />
                        <small class="error">{{form.errors.money}}</small>

                        <Button type="submit" @click="handleForm"  label="Dodaj " class="w-full p-3 text-xl mt-5"></Button>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

