<template>
    <button type="button" class="bg-white shadow-sm min-h-32 w-50 hover:shadow-xl hover:border-indigo-500 transition rounded-lg border-2 border-gray-200 relative">
        <div class="p-3 border-b border-gray-300">
            <div class="flex">
                <div class="w-2/3 text-left">
                    <p class="font-bold">{{ data.name}}</p>
                    <p v-if="data.description" class="text-gray-700">{{ data.description.substring(0,32) + '...' }}</p>
                </div>
                <div class="w-1/3 text-right">
                    <p class="text-md" v-if="!data.hasPriceIncrease">€ {{ data.price }}</p>
                    <p class="text-md" v-if="data.hasPriceIncrease">+ {{ data.priceIncrease }} %</p>
                </div>
            </div>
        </div>
        <div class="p-3 flex justify-center items-center">
            <img :src="data.thumbnailPreview" v-if="data.thumbnailPreview" width="100" height="100"/>
        </div>
        <div class="p-3 text-left">
            <p class="text-gray-500 text-sm" v-if="data.weight">Weight: {{ data.weight }}</p>
            <p class="text-gray-500 text-sm" v-if="data.height">Height: {{ data.height }}</p>
            <p class="text-gray-500 text-sm" v-if="data.length">Length: {{ data.length }}</p>
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
    props: ['data']
}
</script>
