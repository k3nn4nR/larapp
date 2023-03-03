<script setup>
import { ref  } from 'vue';
import VueApexCharts from 'vue3-apexcharts'

const total = ref(0);
const headers = {headers: {
    'Content-type':'application/json',
    'Authorization':'Bearer '+localStorage.getItem('token')
}}
const options = {
    chart: {
        id: 'vuechart-example'
    },
    series: [{
        name: 'series-1',
        data: []
    }],
    xaxis: {
        categories: []
    }
}

axios.get(route('test'),headers).then(response=>{})
axios.get(route('item_dashboard'),headers).then(response=>{
    total.value = response.data.total
    options.xaxis.categories = response.data.item_keys
    options.series[0].data = response.data.item_count
    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
})
</script>

<template>
    <div class="flex justify-center">
        <div class="block p-6 rounded-lg shadow-lg bg-white max-w-sm">
            <h5 class="text-gray-900 text-xl leading-tight font-medium mb-2">Card title</h5>
            <apexchart id="chart" type="bar" :options="options"></apexchart>
        </div>
    </div>
</template>
