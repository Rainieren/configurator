<template>
    <div class="space-y-4 my-5">
        <div class="flex flex-column xl:flex-row space-y-4 xl:space-y-0 xl:space-x-4">
            <div class="flex flex-column xl:space-y-4 space-y-4 xl:space-y-0 w-100 xl:w-2/6">
                <div class="bg-white border border-gray-200 rounded-lg w-100">
                    <div class="p-5 space-y-1">
                        <p class="text-sm md:text-base xl:text-lg">Lifetime sales</p>
                        <div class="flex space-x-3 my-1">
                            <div class="flex items-end">
                                <p class="text-indigo-500 text-2xl font-bold">
                                    {{ sumPrice | currency('€ ')}}
                                </p>
                            </div>
                            <div class="flex items-end hidden">
                                <p class="text-gray-500 text-sm font-medium">
                                    from {{ averagePrice | currency('€ ')}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white border border-gray-200 rounded-lg w-100">
                    <div class="p-5 space-y-1">
                        <p class="text-sm md:text-base xl:text-lg">Average price</p>
                        <div class="flex space-x-3 my-1">
                            <div class="flex items-end">
                                <p class="text-indigo-500 text-2xl font-bold" v-if="averagePrice">
                                    {{ averagePrice | currency('€ ')}}
                                </p>
                                <p class="text-indigo-500 text-2xl font-bold" v-else>
                                    –
                                </p>
                            </div>
                            <div class="flex items-end hidden">
                                <p class="text-gray-500 text-sm font-medium">
                                    from {{ averagePrice | currency('€ ')}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white border border-gray-200 rounded-lg">
                    <div class="p-5 space-y-1">
                        <p class="text-sm md:text-base xl:text-lg">Amount of configured products</p>
                        <div class="flex space-x-3 my-1">
                            <div class="">
                                <div class="flex items-end">
                                    <p class="text-indigo-500 text-2xl font-bold">
                                        {{ summaries.length }}
                                    </p>
                                </div>
                                <div class="flex items-end hidden">
                                    <p class="text-gray-500 text-sm font-medium">
                                        from 50
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white border border-gray-200 rounded-lg">
                    <div class="p-5 space-y-1">
                        <p class="text-sm md:text-base xl:text-lg">Most populair product</p>
                        <div class="flex">
                            <p class="text-indigo-500 text-2xl font-bold">
                                {{ popularProduct.name }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-column xl:space-y-4 space-y-4 xl:space-y-0 w-100 xl:w-4/6">
                <div class="bg-white border border-gray-200 rounded-lg h-full">
                    <div class="p-5 space-y-1">
                        <p class="text-sm md:text-base xl:text-lg mb-3">Revenue over time</p>
                        <div class="h-96" v-if="chartStatistics || Object.entries(chartStatistics).length > 1">
                            <canvas id="purchasesChart"></canvas>
                        </div>
                        <div v-else class="flex items-center justify-center flex-column">
                            <p class="font-medium text-lg">There are no statistics available yet</p>
                            <img :src="'/images/empty_1.svg'" class="w-56 my-24" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-column xl:space-y-4 space-y-4 xl:space-y-0 w-100">
            <div class="flex flex column space-y-4 w-100 xl:w-3/6">
                <div class="bg-white border border-gray-200 rounded-lg w-full">
                    <div class="p-5 space-y-1">
                        <p class="text-sm md:text-base xl:text-lg mb-3">Recent summaries</p>
                        <table class="w-100" v-if="summaries.length">
                            <thead>
                                <th>Product</th>
                                <th>Total</th>
                                <th>Created_at</th>
                            </thead>
                            <tbody v-for="summary in summaries.slice(-5)">
                                <td class="py-1">{{ summary.products[0].name}}</td>
                                <td class="py-1">{{ summary.total | currency('€ ')}}</td>
                                <td class="py-1">{{ getTimeForHumans(summary.created_at) }}</td>
                            </tbody>
                        </table>
                        <div class="" v-else>
                            <p class="text-center">There are no summaries yet.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import Chart from 'chart.js'
import moment from "moment";

export default {
    data() {
        return {
            summaries: [],
            averagePrice: 0,
            sumPrice: 0,
            popularProduct: '',
            chartStatistics: [],
        }
    },
    mounted: function() {
        this.getConfigurationsSum();
        this.getConfigurationAverage();
        this.getMostPopularProduct();
        this.getChartStatistics();

    },
    // mixins: [Line],
    methods: {
        getTimeForHumans(time) {
            return moment(time).format('LL');
        },
        getConfigurationsSum: function() {
            axios.get('/api/get/all/summaries')
                .then(response => {
                    this.summaries = response.data
                    this.getConfigurationAverage();
                }).catch(err => {
                console.log(err)
            });
        },
        getConfigurationAverage: function() {
            let sum = 0;
            this.summaries.forEach((value, index) => {
                sum += parseFloat(value['total'])
            });
            this.sumPrice = sum
            this.averagePrice = sum / this.summaries.length;
        },
        getMostPopularProduct: function() {
            axios.get('/api/get/popular_product')
                .then(response => {
                    this.popularProduct = response.data
                }).catch(err => {
                console.log(err)
            });
        },
        getChartStatistics: function() {
            axios.get('/api/get/summary_statistics')
                .then(response => {
                    this.chartStatistics = response.data
                    this.renderChart(Object.keys(this.chartStatistics), Object.values(this.chartStatistics))
                }).catch(err => {
                console.log(err)
            });
        },
        renderChart: function(labels, data) {
            var ctx = document.getElementById('purchasesChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Amount of revenue',
                        data: data,
                        backgroundColor: [
                            'rgba(99, 102, 241, 0)',
                        ],
                        borderColor: [
                            'rgba(99, 102, 241, 1)',
                        ],
                        borderWidth: 3,
                    }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    elements: {
                        point:{
                            radius: 1
                        }
                    },
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                        yAxes: [{
                            ticks: {
                                callback: function(value, index, values) {
                                    if (parseInt(value) >= 1000) {
                                        return '€' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                                    } else {
                                        return '€' + value;
                                    }
                                }
                            },
                            gridLines: {
                                display: false,
                                drawBorder: false,
                            }
                        }],
                        xAxes: [{
                            gridLines: {
                                display: false,
                                drawBorder: false,
                            }
                        }]
                    },
                }
            });
        }
    }
}
</script>
