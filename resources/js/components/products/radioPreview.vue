<template>
    <div class="text-center flex flex-column items-center">
        <button type="button" class="rounded-full bg-white hover:border-indigo-500 hover:shadow-lg transition h-24 w-24  border border-gray-300 flex items-center justify-center">
            <div class="rounded-full bg-red-500 h-16 w-16"></div>
        </button>
        <p class="font-medium my-2">{{ data.name }}</p>
        <p class="text-md" v-if="!data.hasPriceIncrease">€ {{ data.price }}</p>
        <p class="text-md" v-if="data.hasPriceIncrease">+ {{ data.priceIncrease }} %</p>
    </div>
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
