<template>
    <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-5 my-4">
        <div class="bg-gray-100 rounded-xl">
            <div class="p-5 space-y-1">
                <p class="text-gray-500 text-sm uppercase tracking-widest font-semibold">Amount of configured products</p>
                <div class="flex">
                    <p class="text-gray-900 text-3xl font-bold my-5">
                        {{ summaries.length }}
                    </p>
                </div>
            </div>
        </div>
        <div class="bg-gray-100 rounded-xl">
            <div class="p-5 space-y-1">
                <p class="text-gray-500 text-sm uppercase tracking-widest font-semibold">Average price</p>
                <div class="flex">
                    <p class="text-gray-900 text-3xl font-bold my-5">
                        —
                    </p>
                </div>
            </div>
        </div>
        <div class="bg-gray-100 rounded-xl">
            <div class="p-5 space-y-1">
                <p class="text-gray-500 text-sm uppercase tracking-widest font-semibold">Most populair product</p>
                <div class="flex">
                    <p class="text-gray-900 text-3xl font-bold my-5">
                        —
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            summaries: [],
            averagePrice: 0
        }
    },
    mounted: function() {
        this.getConfigurationsSum();
    },
    methods: {
        getConfigurationsSum: function()
        {
            axios.get('/api/get/all/summaries')
                .then(response => {
                    this.summaries = response.data
                    this.getConfigurationAverage();
                }).catch(err => {
                console.log(err)
            });
        },
        getConfigurationAverage: function()
        {
            let sum = 0;
            this.summaries.forEach((value, index) => {
                sum += parseFloat(value['total'])
            });

            this.averagePrice = sum / this.summaries.length;
        }
    }
}
</script>
