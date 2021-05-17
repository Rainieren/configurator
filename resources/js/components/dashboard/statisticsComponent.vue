<template>
    <div class="grid grid-cols-3 gap-5 my-4">
        <div class="bg-gray-100 rounded-xl">
            <div class="p-5 space-y-1">
                <p class="text-gray-500 text-sm uppercase tracking-widest font-semibold">Totaal geconfigureerde producten</p>
                <div class="flex">
                    <p class="text-gray-900 text-3xl font-bold">
                        {{ summaries.length }}
                    </p>
                </div>
            </div>
        </div>
        <div class="bg-gray-100 rounded-xl">
            <div class="p-5 space-y-1">
                <p class="text-gray-500 text-sm uppercase tracking-widest font-semibold">Gemiddelde prijs</p>
                <div class="flex">
                    <p class="text-gray-900 text-3xl font-bold">
                        {{ parseFloat(averagePrice) | currency('€ ') }}
                    </p>
                </div>
            </div>
        </div>
        <div class="bg-gray-100 rounded-xl">
            <div class="p-5 space-y-1">
                <p class="text-gray-500 text-sm uppercase tracking-widest font-semibold">Populairst product</p>
                <div class="flex">
                    <p class="text-gray-900 text-3xl font-bold">T-Shirt</p>
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
