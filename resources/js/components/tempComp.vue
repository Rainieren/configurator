<template>
    <div>
        <div class="bg-white absolute h-screen w-screen top-0 right-0 overflow-hidden z-30 flex items-center justify-center flex-column" v-if="loading">
            <svg class="animate-spin h-16 w-16 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <p class="my-3">Even geduld aub..</p>
        </div>
        <div class="flex flex-col xl:flex-row" v-if="!loading">
            <div class="configurator bg-white xl:w-8/12 w-full min-h-screen p-20 space-y-15">
                <h1 class="text-5xl font-serif mb-20">Product configureren</h1>
                <!--        TODO:: Move this part into a new component called configurableProductComponent.vue -->
                <div class="grid grid-cols-3 gap-6">

                    <div class="bg-white border-2 min-h-32 w-100 rounded-md shadow-sm hover:border-2 hover:border-indigo-600 cursor-pointer" v-for="product in configurableProducts" :key="product.id">
                        <div class="p-3 border-b border-gray-300">
                            <div class="flex">
                                <div class="w-2/3">
                                    <p class="font-bold">{{ product.name }}</p>
                                    <p v-if="product.description" class="text-gray-800">{{ product.description.substring(0,32) }}</p>
                                </div>
                                <div class="w-1/3 text-right">
                                    <p class="text-md">€ {{ product.price }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-3 flex justify-center items-center">
                            <img class="rounded" :src="product.thumbnail" width="50%">
                        </div>
                        <div class="p-3">
                            <p class="text-gray-500 text-sm">Height: {{ product.height }}</p>
                            <p class="text-gray-500 text-sm">Length: {{ product.length }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <a href="/dashboard/flash">Klik hier</a>

            <!--                <div class="preview bg-gray-100 xl:w-4/12 w-full border-l border-gray-300 h-screen fixed top-0 right-0 shadow-md z-10">-->
            <!--                    <div class="h-4/5">-->
            <!--                        <div class="border-b border-gray-300 h-1/4 flex justify-center items-center">-->
            <!--                            Product preview-->
            <!--                        </div>-->
            <!--                        <div class="p-16">-->
            <!--                            <div class="border-b border-gray-300 py-6 flex">-->
            <!--                                <div class="w-1/2">-->
            <!--                                    <p class="text-gray-500">Subtotaal</p>-->
            <!--                                </div>-->
            <!--                                <div class="w-1/2 text-right">-->
            <!--                                    <p class="text-gray-500">€ 500.00</p>-->
            <!--                                </div>-->
            <!--                            </div>-->
            <!--                            <div class="border-b border-gray-300 py-6 flex">-->
            <!--                                <div class="w-1/2">-->
            <!--                                    <p class="text-gray-500">Verzending</p>-->
            <!--                                </div>-->
            <!--                                <div class="w-1/2 text-right">-->
            <!--                                    <p class="text-gray-500">GRATIS</p>-->
            <!--                                </div>-->
            <!--                            </div>-->
            <!--                            <div class="py-6 flex">-->
            <!--                                <div class="w-1/2">-->
            <!--                                    <p class="text-black text-2xl font-serif">Totaal</p>-->
            <!--                                </div>-->
            <!--                                <div class="w-1/2 text-right">-->
            <!--                                    <p class="text-black text-2xl font-serif">€ 500.00</p>-->
            <!--                                </div>-->
            <!--                            </div>-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                    <div class="border-t border-gray-300 p-16 space-y-2 h-1/5 ">-->
            <!--                        <p class="font-bold">Need help?</p>-->
            <!--                        <p class="text-gray-500"> We zijn er altijd</p>-->

            <!--                        STEP TYPE: cards, tabs, list,-->
            <!--                        Product: is optioneel. Als optioneel, optie need dankje-->
            <!--                    </div>-->
            <!--                </div>-->
        </div>
    </div>
</template>

<script>
export default {
    data () {
        return {
            loading: true,
            configurableProducts: [],
        };
    },
    created () {
        this.getConfigurableProducts();
    },
    methods: {
        getConfigurableProducts: function() {
            axios.get('/api/get/configurable_products')
                .then(response => {
                    this.configurableProducts = response.data
                    this.loading = false
                }).catch(err => {
                console.log(err)
            });
        }
    }
}
</script>
