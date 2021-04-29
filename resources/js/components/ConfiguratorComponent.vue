<template>
    <div class="">
        <input class="border border-2 border-gray-300 m-3 p-2" type="text" v-model="customText" placeholder="Vul wat in">

        <p class="text-2xl text-black">{{ customText }}</p>

        <div class="flex m-5 w-100 gap-10">
            <div class="w-1/2 space-y-10">
                <div class="grid grid-cols-3 gap-6">
                    <button v-for="product in products" v-bind:key="product.id" type="button" class="shadow rounded-lg border-2 border-gray-200 p-3" v-on:click="[activeProduct = product, summary = activeProduct.price]" :class="{active: activeProduct === product }">
                        {{ product.name }} € {{ product.price }}
                    </button>
                </div>
                <div class="space-y-5">
                    <div v-for="step in steps" v-bind:key="step.id" class="bg-white shadow rounded-lg p-3">
                        <p class="text-black text-xl mb-3">{{ step.name }}</p>
                        <div class="grid grid-cols-3 gap-6">
                            <button v-on:click="[summary += option.price, chosenOptions.push(option)]" v-for="option in step.options" v-bind:key="option.id" :class="{'disabled': !activeProduct,  'enabled': activeProduct}" class="bg-white p-3 sm border-2 border-gray-200">
                                {{ option.name }} {{ option.price }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-1/2">
                <p class="text-black">Gekozen producten:</p>
                <ul class="">
                    <li class="my-2" v-for="option in chosenOptions">
                        {{ option.name }} € {{ option.price }}
                    </li>
                </ul>
                <p class="text-black text-3xl font-bold">Totaal: € {{ summary }}</p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                customText: '',
                activeProduct: '',
                chosenOptions: [],
                summary: 0,
                steps: [
                    { name: 'Size', belongsTo: [0,1,2], options: [
                        { id: 0, name: 'M', price: 1 },
                        { id: 1, name: 'L', price: 2 },
                        { id: 2, name: 'XL', price: 3 }
                    ]},
                    { name: 'Color', belongsTo: [0,1], options: [
                            { id: 0, name: 'Red', price: 5 },
                            { id: 1, name: 'Blue', price: 5 },
                            { id: 2, name: 'Yellow', price: 10 }
                    ]},
                    { name: 'Material', belongsTo: [0,1,2], options: [
                            { id: 0, name: 'Leather', price: 100 },
                            { id: 1, name: 'Cotton', price: 25 },
                            { id: 2, name: 'Paper', price: 5 }
                    ]}
                ],
                products: [
                    { id: 0, name: 'T-Shirt', price: 10 },
                    { id: 1, name: 'Hoodie', price: 15 },
                    { id: 2, name: 'Pants', price: 15 }
                ]
            };
        },
        methods: {
            // addToSummary: function(id) {
            //     if()
            // }
        }
    }
</script>

<style>
    .active {
        border-color: #ff0000 !important;
    }

    .active_option {
        border-color: #0000ff !important;
    }

    .disabled {
        background-color: rgba(45, 55, 72, 0.4) !important;
        cursor: not-allowed !important;
    }

    .enabled {
        background-color: #ffffff !important;
        cursor: pointer !important;
    }
</style>
