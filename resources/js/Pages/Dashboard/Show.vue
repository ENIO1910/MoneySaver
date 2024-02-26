<script setup>

import AppLayout from "@/layout/AppLayout.vue";
import {ref, onMounted, computed} from "vue";

const props = defineProps({
    categories: Object,
    thisMonthStats: Object
})


const thisMonthStats = computed(() => {
    return props.thisMonthStats;
});

const categories = thisMonthStats.value.categories;
const total = thisMonthStats.value.total

onMounted(() => {
    chartData.value = setChartData();
    chartOptions.value = setChartOptions();
});

const chartData = ref();
const chartOptions = ref();

const dataValues = Object.values(categories);

const amountList = dataValues.map(item => item.amount);
const labels = dataValues.map(item => item.description);
const setChartData = () => {
    const documentStyle = getComputedStyle(document.documentElement);

    return {
        labels: labels,
        datasets: [
            {
                data: amountList,
                fill: false,
                label: '',
                borderColor: documentStyle.getPropertyValue('--gray-500'),
                backgroundColor: [
                    '#1055ab',
                    '#2CA58D',
                    '#84BC9C',
                    '#C2DDCA',
                    '#FFFDF7',
                    '#F46197',
                    '#cc131c'
                ],
                hoverBackgroundColor: [documentStyle.getPropertyValue('#0A2342')],

                tension: 0.4
            },
        ]
    };
};
const setChartOptions = () => {
    const documentStyle = getComputedStyle(document.documentElement);
    const textColor = documentStyle.getPropertyValue('--text-color');

    return {
        plugins: {
            legend: {
                labels: {
                    usePointStyle: true,
                    color: textColor,
                },
            },
        },
    };
}
const date = ref();

</script>

<template>
    <AppLayout>
        <div class="grid">
            <div class="col-12">
                <div class="card">
                    <h1>Dashboard</h1>
                </div>
                <div class="card">
                    <h2>Podsumowanie miesiąca</h2>
                    <div class="grid col-12">
                        <div class="col-12 text-center xl:col-6">
                            <Calendar class="my-5" v-model="date" inline showWeek />
                        </div>
                        <div class="col-12 xl:col-6">
                            <Chart type="pie" :data="chartData" :options="chartOptions"  class="h-30rem w-full flex justify-content-center"></Chart>
                        </div>
                    </div>
                    <div class="flex justify-content-center  mt-5">
                        <h3>Suma wydatków w tym miesiącu</h3>
                    </div>
                    <Badge class="w-full h-5rem" style="background: linear-gradient(90deg, #38ce83 0%, #31ce46 100%)" >
                        <span class="text-lg text-white flex align-items-center justify-content-center h-full">
                                {{total}} PLN
                        </span>
                    </Badge>
                </div>

            </div>
        </div>

    </AppLayout>
</template>
