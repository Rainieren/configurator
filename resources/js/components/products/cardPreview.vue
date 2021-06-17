<template>
    <button type="button" class="bg-white shadow-sm min-h-32 w-50 hover:shadow-xl hover:border-indigo-500 transition rounded-lg border-2 border-gray-200 relative my-5" :class="{'pointer-events-none opacity-50': data.stock === 0 || data.stock === '0'}">
        <div class="p-3 border-b border-gray-300">
            <div class="flex">
                <div class="w-2/3 text-left overflow-hidden break-word">
                    <p class="font-bold">{{ data.name}}</p>
                    <p v-if="data.description" class="text-gray-700">{{ data.description.substring(0,32) + '...' }}</p>
                </div>
                <div class="w-1/3 text-right">
                    <p class="text-md" v-if="!data.hasPriceIncrease">€ {{ data.price }}</p>
                    <p class="text-md" v-if="data.hasPriceIncrease">+ {{ data.priceIncrease }} %</p>
                    <p class="" v-if="data.stock === '1' || data.stock === 1">
                        <span class="text-green-500 font-medium font-sm flex justify-end align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            In stock
                        </span>
                    </p>
                    <p v-if="data.stock === '0' || data.stock === 0">
                        <span class="text-red-500 font-medium font-sm flex justify-end align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                            Out of stock
                        </span>
                    </p>
                </div>
            </div>
        </div>
        <div class="p-3 flex justify-center items-center h-64">

                <img :src="data.thumbnail" v-if="checkIfIsFile(data.thumbnail) === false" class="object-contain object-center h-full w-full rounded-xl"/>
            <transition enter-active-class="animate__animated animate__fadeIn" leave-active-class="animate__animated animate__fadeOut" mode="out-in">
                <img :src="data.thumbnailPreview" v-if="data.thumbnailPreview" class="object-contain object-center h-full w-full rounded-xl"/>
            </transition>
        </div>
        <div class="p-3 text-left">
            <p class="text-gray-500 text-sm" v-if="data.weight">Weight: {{ data.weight }}</p>
            <p class="text-gray-500 text-sm" v-if="data.height">Height: {{ data.height }}</p>
            <p class="text-gray-500 text-sm" v-if="data.length">Length: {{ data.length }}</p>
            <p class="text-gray-500 text-sm" v-if="data.width">Width: {{ data.width }}</p>
        </div>
        <span class="bg-indigo-500 text-white rounded-full px-3 py-1 shadow-lg absolute font-medium" v-if="data.newFrom" style="top: -20px; right: -20px">New!</span>
    </button>
</template>

<script>
export default {
    data() {
        return {

        }
    },
    props: ['data'],
    methods: {
        checkIfIsFile(value) {
            if(value === "") {
                return true
            } else {
                return value instanceof File
            }

        }
    }
}
</script>
