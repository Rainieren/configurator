<template>
    <div class="flex space-x-4">
        <div class="flex flex-column space-y-4 w-2/6 my-4">
            <div class="bg-white border border-gray-200 rounded-lg w-100">
                <div class="p-5 space-y-1">
                    <p class="text-lg ">Lifetime configurations sum</p>
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
                    <p class="text-lg ">Average configuration price</p>
                    <div class="flex space-x-3 my-1">
                        <div class="flex items-end">
                            <p class="text-indigo-500 text-2xl font-bold">
                                {{ averagePrice | currency('€ ')}}
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
                    <p class="text-lg">Amount of configured products</p>
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
                    <p class="text-lg">Most populair product</p>
                    <div class="flex">
                        <p class="text-indigo-500 text-2xl font-bold">
                            {{ popularProduct.name }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-column space-y-4 w-4/6 my-4">
            <div class="bg-white border border-gray-200 rounded-lg">
                <div class="p-5 space-y-1">
                    <p class="text-lg">Purchases over time</p>
                    <canvas id="myChart"></canvas>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
import Chart from 'chart.js'

export default {
    data() {
        return {
            summaries: [],
            averagePrice: 0,
            sumPrice: 0,
            popularProduct: '',
            data: [],
        }
    },
    mounted: function() {
        this.getConfigurationsSum();
        this.getConfigurationAverage();
        this.getMostPopularProduct();

    },
    // mixins: [Line],
    methods: {
        getConfigurationsSum: function() {
            axios.get('/api/get/all/summaries')
                .then(response => {
                    this.summaries = response.data
                    this.getConfigurationAverage();
                    this.createChart();
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
        createChart: function() {
            let data = [];
            this.summaries.forEach((value, index) => {
                data.push(parseFloat(value['total']))
            });
            console.log(data)
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data,
                    datasets: [{
                        label: '# Purchased',
                        data: data,
                        backgroundColor: [
                            'rgba(99, 102, 241, 0.5)',
                        ],
                        borderColor: [
                            'rgba(99, 102, 241, 1)',
                        ],
                        borderWidth: 1,
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                        yAxes: [{
                            ticks: {
                                callback: function(value, index, values) {
                                    if (parseInt(value) >= 1000) {
                                        return '€' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    } else {
                                        return '€' + value;
                                    }
                                }
                            },
                            gridLines: {
                                display: false
                            }
                        }],
                        xAxes: [{
                            gridLines: {
                                display: false
                            }
                        }]
                    },
                }
            });
        }
    }
}
</script>
