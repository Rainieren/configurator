<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <transition name="fade">
        <div v-if="showModal" class="fixed z-20 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!--
                  Background overlay, show/hide based on modal state.

                  Entering: "ease-out duration-300"
                    From: "opacity-0"
                    To: "opacity-100"
                  Leaving: "ease-in duration-200"
                    From: "opacity-100"
                    To: "opacity-0"
                -->
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 backdrop-filter backdrop-blur-sm transition-opacity transition" aria-hidden="true" @click="showModal = false"></div>

                <!-- This element is to trick the browser into centering the modal contents. -->
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <!--
                  Modal panel, show/hide based on modal state.

                  Entering: "ease-out duration-300"
                    From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    To: "opacity-100 translate-y-0 sm:scale-100"
                  Leaving: "ease-in duration-200"
                    From: "opacity-100 translate-y-0 sm:scale-100"
                    To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                -->
                <div class="w-full md:w-1/2 xl:w-1/4 inline-block bg-white rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle">
                    <div class="bg-white relative">
                        <button @click="showModal = false" class="absolute top-5 right-5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                        <div class="p-16">
                            <img :src="product.thumbnail" class="w-100" alt="">


                        </div>
                        <div class="px-10 pb-10">
                            <div class="flex">
                                <div class="w-1/2">
                                    <p class="text-lg font-bold mb-2">{{ product.name }}</p>
                                </div>
                                <div class="w-1/2 flex justify-end">
                                    <p class="text-lg font-bold mb-2">{{ parseFloat(product.price) | currency('€ ') }}</p>
                                </div>
                            </div>

                            <p class="my-3">{{ product.description }}</p>
                            <div class="" v-if="product.height || product.length || product.width || product.weight">
                                <p class="font-medium">Product specificaties:</p>
                                <div class="my-2">
                                    <p class="text-gray-500 text-sm" v-if="product.height">Height: {{ product.height }}</p>
                                    <p class="text-gray-500 text-sm" v-if="product.length">Length: {{ product.length }}</p>
                                    <p class="text-gray-500 text-sm" v-if="product.length">Width: {{ product.width }}</p>
                                    <p class="text-gray-500 text-sm" v-if="product.length">Weight: {{ product.weight }}</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
export default {
    // props: ['product'],
    data () {
        return {
            product: '',
            showModal: false,
        };
    },
    created() {
        window.addEventListener('keydown', (e) => {
           if(e.key === 'Escape') {
               this.showModal = false;
           }
        });
    }
}
</script>
