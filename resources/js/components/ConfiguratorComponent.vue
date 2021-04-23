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

            <div class="grid grid-cols-6 gap-6">
                <div v-on:click="showSteps = true" class="bg-white border-2 h-32 w-100 rounded-md shadow-sm hover:border-2 hover:border-indigo-600 cursor-pointer flex items-center justify-center" v-for="product in configurableProducts" :key="product.id">
                    {{ product.id }}
                </div>
            </div>
<!--            <div class="text-black text-2xl"  v-for="step in product.steps" :key="step.id">{{ step.name }}</div>-->

<!--            <div class="">-->
<!--                <p class="m-0 text-3xl font-serif mb-4">Choose a product you would like to configure</p>-->
<!--                <div class="grid grid-cols-4 gap-6">-->
<!--                    <div class="bg-white border border-gray-200 rounded-md">-->
<!--                        <div class="px-4 py-3 border-b">-->
<!--                            <div class="flex">-->
<!--                                <div class="w-2/3">-->
<!--                                    <p class="m-0 font-bold">Titel product</p>-->
<!--                                    <p class="m-0 text-gray-800">Omshcrijving van product</p>-->
<!--                                </div>-->
<!--                                <div class="w-1/3 text-right">-->
<!--                                    <p class="font-md">-->
<!--                                        € - -->
<!--                                    </p>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="px-4 py-3 flex justify-center items-center">-->
<!--                            Foto-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->

<!--            <hr class="my-5">-->
        </div>

        <div class="preview bg-gray-100 xl:w-4/12 w-full border-l border-gray-300 h-screen fixed top-0 right-0 shadow-md z-10">
            <div class="h-4/5">
                <div class="border-b border-gray-300 h-1/4 flex justify-center items-center">
                    Product preview
                </div>
                <div class="p-16">
                    <div class="border-b border-gray-300 py-6 flex">
                        <div class="w-1/2">
                            <p class="text-gray-500">Subtotaal</p>
                        </div>
                        <div class="w-1/2 text-right">
                            <p class="text-gray-500">€ 500.00</p>
                        </div>
                    </div>
                    <div class="border-b border-gray-300 py-6 flex">
                        <div class="w-1/2">
                            <p class="text-gray-500">Verzending</p>
                        </div>
                        <div class="w-1/2 text-right">
                            <p class="text-gray-500">GRATIS</p>
                        </div>
                    </div>
                    <div class="py-6 flex">
                        <div class="w-1/2">
                            <p class="text-black text-2xl font-serif">Totaal</p>
                        </div>
                        <div class="w-1/2 text-right">
                            <p class="text-black text-2xl font-serif">€ 500.00</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-300 p-16 space-y-2 h-1/5 ">
                <p class="font-bold">Need help?</p>
                <p class="text-gray-500"> We zijn er altijd</p>

                STEP TYPE: cards, tabs, list,
                Product: is optioneel. Als optioneel, optie need dankje
            </div>
        </div>
    </div>
</div>

</template>

<script>
    export default {
        data () {
            return {
                loading: true,
                products: [],
                chosenProducts: []
            };
        },
        computed: {
            configurableProducts() {
                return this.products.filter(product => product.step_id === null)
            }
        },
        created () {
            this.getProducts();
        },
        methods: {
            getProducts: function() {
                axios.get('/api/get/products')
                    .then(response => {
                        this.products = response.data
                        this.loading = false
                    }).catch(err => {
                    console.log(err)
                });
            }
        }
    }
</script>
