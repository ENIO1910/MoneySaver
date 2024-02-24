<script setup lang="ts">

import {computed} from "vue";
import {useToast} from "primevue/usetoast";
import {useForm} from "@inertiajs/vue3";

const active = defineModel<boolean>('active');
const props = defineProps<{walletId:number}>()
const walletId = computed<number>(()=> props.walletId)
const toast = useToast();

const form = useForm({
    money: null,
});
const handleForm = () => {
    form.transform((data) => ({
    money: data.money * 100,
})).post(route('wallets.deposit', {walletId: walletId.value}), {
        onSuccess: () => {
            toast.add({severity: 'success', summary: 'Udało się dodać środki do portfela', life: 3000});
            form.money = null;
            active.value = false;
            },
        onError: () => {
            toast.add({
                severity: 'warn',
                summary: 'Coś poszło nie tak',
                detail: 'Spróbuj ponownie później',
                life: 3000
            });
        }
    });
}

</script>

<template>
    <Dialog
        v-model:visible="active"
        header="Wartość doładowania"
        :modal=true
        :closable=true
        :style="{width:'450px', margin:'0 15px'}"
    >
        <div class="flex flex-column align-items-center mt-2">
            <InputNumber id="money" type="text" :required="true" mode="currency" currency="PLN" placeholder="Wpisz wartość doładowania" class="w-full md:w-30rem mb-2" inputClass="w-full" :inputStyle="{ padding: '1rem' }" v-model="form.money" />
            <small class="error">{{form.errors.money}}</small>
            <div class="flex w-full justify-content-between mt-5">
                <Button @click="active = false" label="Zamknij" class="p-button-danger"/>
                <Button :loading="form.processing" @click="handleForm" label="Wpłać" class="p-button-success"/>
            </div>
        </div>
    </Dialog>
</template>

<style scoped lang="scss">

</style>
