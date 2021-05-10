<template>
    <div class="bg-gray-100 xl:w-4/12 w-full border-l border-gray-300 h-screen fixed top-0 right-0 shadow-sm z-10">
        <div class="h-4/5">
            <div class="border-b border-gray-300 flex justify-center items-center">
                <img :src="active.thumbnail" v-if="active" class="shadow-sm h-32 w-32"  alt="">
                <img :src="option[0].option.thumbnail" class="shadow-sm h-32 w-32" v-for="option in options" alt="">
            </div>
            <div class="p-16">
                <div class="border-b border-gray-300 py-6 flex" v-if="active">
                    <div class="w-1/2 flex">
                        <div class="bg-white border rounded-sm border-black w-auto text-center min-w-0 shadow-sm px-1 mr-2">
                            Product
                        </div>
                        <p class="text-gray-700">{{ active.name }}</p>
                    </div>
                    <div class="w-1/2 text-right">
                        <p class="text-gray-700">{{ parseFloat(active.price) | currency('€ ') }}</p>
                    </div>
                </div>

                <div class="border-b border-gray-300 py-6 flex" v-for="option in options">

                    <div class="w-1/2 flex">
                        <div class="bg-white border rounded-sm border-black w-auto text-center min-w-0 shadow-sm px-1 mr-2">
                            {{option[0].step}}
                        </div>
                        <p class="text-gray-700">{{ option[0].option.name }}</p>
                    </div>
                    <div class="w-1/2 text-right">
                        <p class="text-gray-700">{{ parseFloat(option[0].option.price) | currency('€ ') }}</p>
                    </div>
                </div>
                <div class="border-b border-gray-300 py-6 flex">
                    <div class="w-1/2">
                        <p class="text-gray-700">Subtotaal </p>
                    </div>
                    <div class="w-1/2 text-right">
                        <p class="text-gray-700" v-if="active">{{ (parseFloat(active.price)  + sum) | currency('€ ') }}</p>
                    </div>
                </div>
                <div class="border-b border-gray-300 py-6 flex">
                    <div class="w-1/2">
                        <p class="text-gray-700">BTW 21% </p>
                    </div>
                    <div class="w-1/2 text-right">
                        <p class="text-gray-700" v-if="active">{{ (parseFloat(active.price)  + sum) * 0.21 | currency('€ ') }}</p>
                    </div>
                </div>
                <div class="py-6 flex">
                    <div class="w-1/2">
                        <p class="text-black text-2xl font-medium">Total</p>
                    </div>
                    <div class="w-1/2 text-right">
                        <p class="text-black text-2xl font-medium" v-if="active">{{ (parseFloat(active.price) + sum) | currency('€ ') }}</p>
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
</template>

<script>


export default {
    data() {
        return {

        };
    },
    props: ['active', 'options'],
    computed: {
        sum() {
            return this.options.reduce((sum, item) => {
                return sum += parseFloat(item[0].option.price);
            }, 0);
        }
    }
}
</script>
