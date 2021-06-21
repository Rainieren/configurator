<template>
    <transition name="fade">
        <div class="bg-white fixed w-full h-screen top-0 right-0 flex items-center justify-center flex-column z-30" v-if="!configuratorChosen">
            <div class="text-center" v-if="this.configurators.length != 0">
                <h2 class="text-3xl font-medium my-5 animate__animated animate__fadeInUp">What do you like to configure?</h2>
                <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
                    <div v-for="(configurator, i) in this.configurators" class="bg-white shadow-sm relative min-h-32 hover:shadow-xl hover:border-indigo-500 transition rounded-xl border-2 border-gray-200 cursor-pointer animate__animated animate__fadeInUp animate__delay-1s cardhover" :style="styleBorder(configurator.theme_color)">
                        <div v-on:click="getProducts(configurator.id)">
                            <div class="p-3">
                                <p class="font-medium text-xl text-center">{{ configurator.name }}</p>
                                <div class=" flex items-center justify-center w-full my-8">
                                    <img :src="configurator.thumbnail" v-if="configurator.thumbnail" class="h-full w-64" alt="">
                                </div>
                                <p class="text-gray-500">V.a {{ Math.min.apply(Math, lowestPriceInConfigurator(configurator.id)[i]['prices'][0]) | currency('€ ')}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="" v-else>
                <div class="w-100 text-center flex items-center justify-center flex-column">
                    <p class="font-medium text-3xl">There are no configurators. Ask the administrator to make one</p>
                    <img :src="'/images/empty_1.svg'" class="w-25 my-24" alt="">
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
    export default {
        data () {
            return {

            };
        },
        props: ['configuratorChosen', 'configurators','getConfigurableProducts'],
        methods: {
            styleBorder: function(themeColor) {
                return {'--borderHoverColor': themeColor};
            },
            lowestPriceInConfigurator: function(id) {
                let array = [];
                this.configurators.forEach(function(value, i) {
                    let prices =  []
                    value.products.forEach(function(item, i) {
                        if(item.configurable) {
                            prices.push(parseFloat(item.price))
                        }
                    })
                    array.push({configurator: i, prices: [prices]})
                });
                return array;
            },
            getProducts: function(id) {
                this.getConfigurableProducts(id)
            }
        }
    }
</script>
