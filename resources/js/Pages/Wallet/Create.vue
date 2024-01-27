<script setup>
import AppLayout from "@/layout/AppLayout.vue";
import { ref, computed } from 'vue';
import {useForm} from "@inertiajs/vue3";
import { useToast } from "primevue/usetoast";



const props = defineProps({
    data: String,
})


const errors = ref({})


const categories = ref([
    { name: 'Zakupy spożywcze', code: 'GROCERIES' },
    { name: 'Kosmetyki', code: 'COSMETICS' },
    { name: 'Opłaty', code: 'FEE' },
    { name: 'Kredyt', code: 'CREDIT' },
    { name: 'Rozrywka', code: 'ENTERTAINMENT' },
    { name: 'Rozwój', code: 'DEVELOPMENT' },
    { name: 'Nieprzewidziany wydatek', code: 'UNFORESEEN' },
]);

const form = useForm({
    money: null,
    category: null,
    createdAt: new Date(),

})
const toast = useToast();


const handleForm = () => {
    form.post(route('expenses.store'), {
        onSuccess: () => {
            form.money = null
            form.category = null
            toast.add({ severity: 'info', summary: props.data, life: 3000 });
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
            <Toast />

            <div class="col-12">
                <div class="card">
                    <h1>Dodaj nowy wydatek</h1>
                </div>
            </div>
            <div class="col-12">
                <div class="card mb-0">
                    <div class="flex flex-column justify-content-between mb-3">
                        <label for="money" class="block text-900 text-xl font-medium mb-2">Koszt</label>
                        <InputNumber id="money" type="text" :required="true" placeholder="Wpisz wartość paragonu" class="w-full md:w-30rem mb-2" inputClass="w-full" :inputStyle="{ padding: '1rem' }" v-model="form.money" />
                        <small class="error">{{form.errors.money}}</small>

                        <label for="password" class="block text-900 text-xl font-medium mb-2">Kategoria</label>
                        <Dropdown v-model="form.category" :options="categories" optionLabel="name" option-value="code" placeholder="Wybierz kategorie" class="w-full md:w-30rem mb-2" inputClass="w-full" :inputStyle="{ padding: '1rem' }" />
                        <small class="error">{{form.errors.category}}</small>

                        <label for="password" class="block text-900 text-xl font-medium mb-2">Data</label>
                        <Calendar v-model="form.createdAt" showIcon iconDisplay="input" class="w-full md:w-30rem mb-2" date-format="dd/mm/yy" inputClass="w-full" :inputStyle="{ padding: '1rem' }" />
                        <small class="error">{{form.errors.createdAt}}</small>

                        <Button type="submit" @click="handleForm"  label="Dodaj " class="w-full p-3 text-xl mt-5"></Button>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

