<template>
    <div class="w-full bg-gray-100 xl:w-4/12  h-screen block xl:fixed top-0 right-0 shadow-md z-10 flex flex-col justify-between transition-all overflow-y-scroll">
        <div class="h-auto">
            <div class="border-b border-gray-300 flex justify-center items-center relative h-96" v-if="active">
                <transition enter-active-class="animate__animated animate__fadeIn" leave-active-class="animate__animated animate__fadeOut" mode="out-in">
                    <img :src="active.visualisation" v-if="active" class="h-96 w-auto absolute" alt="">
                </transition>

                <transition-group appear enter-active-class="animate__animated animate__fadeIn" leave-active-class="animate__animated animate__fadeOut" mode="out-in" class="block w-100 h-100 flex justify-center items-center relative">

                    <img v-if="option[0].options[0].visualisation" :src="option[0].options[0].visualisation" :key="option[0].options[0].id" class="h-96 w-auto absolute" v-for="(option, index) in options" alt="">
                </transition-group>


<!--                <div class="" v-for="(option, index) in options">-->
<!--                    <p>{{ option[index].options[0].visualisation }}</p>-->
<!--                </div>-->
<!--                <div v-else>-->
<!--                    <div class="w-100 h-100 flex items-center justify-center text-gray-200">-->
<!--                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">-->
<!--                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />-->
<!--                        </svg>-->
<!--                    </div>-->
<!--                </div>-->
            </div>
            <transition enter-active-class="animate__animated animate__fadeInUp animate__faster" leave-active-class="animate__animated animate__fadeOutUp animate__faster">
                <div class="p-8 md:p-16" v-if="finished">
                    <button @click="finished = false">Klik me</button>
                    <p class="text-2xl">Uw configuratie</p>
                    <div class="border-b border-gray-300 py-8 grid grid-cols-12 gap-6">

                        <div class="col-span-5">
                            <div class="bg-white h-32 w-100 shadow-sm flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>

                        <div class="col-span-7">
                            <div class="flex">
                                <div class="w-1/2">
                                    <p class="font-bold">{{ active.name }}</p>
                                </div>
                                <div class="w-1/2 flex flex-column items-end justify-end">
                                    <p class="font-bold">{{ active.price | currency('€ ') }}</p>
                                </div>
                            </div>
                            <div class="" v-for="(option, index) in options" v-if="option[0].options.length">
                                <ul>
                                    <li class="text-gray-700 flex" v-for="option in option[0].options">
                                        <div class="w-1/2">
                                            {{ option.name }}
                                        </div>
                                        <div class="w-1/2 flex flex-column items-end justify-end">
                                            {{ option.price | currency('€ ') }}
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="flex">
                                <div class="w-1/2">
                                    <p class="text-lg font-bold">Totaal:</p>
                                </div>
                                <div class="w-1/2 flex flex-column items-end justify-end">
                                    <p class="text-lg font-bold">{{ calculateSum | currency('€ ') }}</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </transition>
            <div class="p-8 md:p-16" v-if="!finished">
                <div class="border-b border-gray-300 py-6 flex" v-if="active">
                    <div class="w-1/2 ">
<!--                        <div class="bg-white border rounded-sm border-black w-auto text-center flex align-center justify-center shadow-sm px-1 mr-2">-->
<!--                            Product-->
<!--                        </div>-->
                        <p class="font-bold text-lg">Product</p>
                        <p class="text-gray-700">{{ active.name }}</p>
                    </div>
                    <div class="w-1/2 flex flex-column items-end justify-end">
                        <p class="text-gray-700">{{ parseFloat(active.price) | currency('€ ') }}</p>
                    </div>
                </div>

                <transition-group enter-active-class="animate__animated animate__bounceInRight animate__faster" leave-active-class="animate__animated animate__bounceOutRight animate__faster">
                    <div class="border-b border-gray-300 py-6 flex h-75" v-for="(option, index) in options" v-if="option[0].options.length" :key="option[0].step.id">

                        <div class="w-100">
                            <p class="font-bold text-lg">
                                {{option[0].step.name}}
                            </p>
                            <ul>
                                <li class="text-gray-700 flex" v-for="option in option[0].options">
                                    <div class="w-1/2">
                                        {{ option.name }}
                                    </div>
                                    <div class="w-1/2 flex flex-column items-end justify-end">
                                        {{ option.price | currency('€ ') }}
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </transition-group>

                <div class="border-b border-gray-300 py-6 flex">
                    <div class="w-3/4">
                        <p class="text-gray-700">Subtotaal </p>
                    </div>
                    <div class="w-1/4 text-right">
                        <p class="text-gray-700" v-if="active">{{ calculateSum | currency('€ ') }}</p>
                    </div>
<!--                    // {{ calculateSum - (calculateSum * 0.21) | currency('€ ') }}-->
                </div>
                <div class="border-b border-gray-300 py-6 flex">
                    <div class="w-3/4">
                        <p class="text-gray-700">BTW 21% </p>
                    </div>
                    <div class="w-1/4 text-right">
                        <p class="text-gray-700" v-if="active">{{ calculateSum * 0.21 | currency('€ ') }}</p>
                    </div>
                </div>
                <div class="py-6 flex">
                    <div class="w-1/2">
                        <p class="text-black text-2xl font-medium">Total</p>
                    </div>
                    <div class="w-1/2 text-right">
                        <p class="text-black text-2xl font-medium" v-if="active">{{ calculateSum | currency('€ ') }}</p>
                    </div>
                </div>


            </div>
        </div>
        <div class="border-t border-gray-300 px-8 md:px-16 py-16 space-y-2 h-64 ">
            <p class="font-bold font-lg">Need help?</p>
            <p class="text-gray-500">Lorem ipsum dolar amet rados</p>
            <div class="md:flex md:space-x-10 block">

                <div class="flex items-center my-3 w-100 md:w-1/2">
                    <div class="bg-white border border-gray-100 text-indigo-500 h-12 w-12 rounded-full flex justify-center items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <a href="" class="font-medium ml-3 hover:text-indigo-500 hover:no-underline">info@mcompany.nl</a>
                </div>
                <div class="flex items-center my-3  w-100 md:w-1/2">
                    <div class="bg-white border border-gray-100 text-indigo-500 h-12 w-12 rounded-full flex justify-center items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <a href="" class="font-medium ml-3 hover:text-indigo-500 hover:no-underline">(0)598 45 36 85</a>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
import Vue2Filters from "vue2-filters";

export default {
    data() {
        return {
            sum: 0,

        };
    },
    mixins: [Vue2Filters.mixin],
    props: ['active', 'options', 'finished'],
    methods: {
        calculateOptionsSum: function(list) {
            let total = 0;
            list.forEach(function(item) {
                if(item.price != null) {
                    total += parseFloat(item.price)
                }
            });
            return parseFloat(total);
        }
    },
    computed: {
        calculateSum() {
            let total = 0;
            this.options.forEach(function (item, index) {
                item[0].options.forEach(function(option, index) {
                    if(option.price != null) {
                        total += parseFloat(option.price)
                    }
                }, this);
            }, this)
            return parseFloat(this.active.price) + total;
        },
    }
}
</script>
