<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <div v-if="showModal" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
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
            <div class="w-25 inline-block bg-white rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle">
                <div class="bg-white">
                    <div class="px-5 pt-5">
                        <div class="text-center">
                            <p class="text-3xl leading-6 font-bold text-gray-900" id="modal-title">Uw Configuratie</p>
                            <p class="text-gray-700 my-4">De onderstaande code kunt u koppieren en gebruiken op de site. Daar kunt u het betaalprocess afronden.</p>
                            <div class="flex justify-center flex-column items-center my-5 space-x-4">
                                <div class="border-2 border-dashed w-auto px-5 py-3 flex items-center justify-center text-gray-700">
                                    <p class="font-bold text-2xl" ref="conf_code">{{  code }}</p>
                                </div>
                                <div class="flex space-x-4 my-3">
                                    <button class="py-1" @click="copyCode()">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hover:text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                                        </svg>
                                    </button>
                                    <div class="bg-gray-800 text-white pt-1 px-2 rounded-lg" v-if="isCopied">Copied!</div>

                                    <button class="py-1" >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hover:text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                        </svg>
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="border-t px-5 py-3 ">
                        <p class="font-medium mb-3">Overzicht</p>


                        <div class="flex">
                            <div class="w-1/2 flex my-2">
                                <p class="text-black text-xl font-medium">{{ active.name }}</p>
                            </div>
                            <div class="w-1/2 flex justify-end items-center">
                                <p class="text-black text-xl text-right font-medium">{{ parseFloat(active.price) | currency('€ ') }}</p>
                            </div>
                        </div>
                        <p class="text-xl font-medium"></p>

                        <div class="flex" v-for="option in options">
                            <div class="w-1/2 flex my-2">
                                <div class="bg-white border rounded-sm border-black w-auto text-center min-w-0 shadow-sm px-1 mr-2">
                                    {{option[0].step}}
                                </div>
                                <p class="text-gray-700">{{option[0].option.name }}</p>
                            </div>
                            <div class="w-1/2 flex justify-end items-center">
                                <p class="text-gray-700 text-right">{{ parseFloat(option[0].option.price) | currency('€ ') }}</p>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="w-1/2 flex my-2">
                                <p class="text-black text-2xl font-medium">Totaal</p>
                            </div>
                            <div class="w-1/2 flex justify-end items-center">
                                <p class="text-black text-2xl text-right font-medium">{{ (parseFloat(active.price) + sum) | currency('€ ') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 flex">

                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['active', 'options', 'code'],
    data () {
        return {
            showModal: false,
            // loading: true,
            isCopied: false,
        };
    },
    computed: {
        sum() {
            return this.options.reduce((sum, item) => {
                return sum += parseFloat(item[0].option.price);
            }, 0);
        }
    },
    methods: {
        copyCode: function() {
            let code = this.$refs.conf_code;
            let input_temp = document.createElement('textarea');
            input_temp.innerHTML = code.innerHTML;
            document.body.appendChild(input_temp);
            input_temp.select();
            document.execCommand('copy');
            this.isCopied = true
            this.hideCopy();
        },
        hideCopy: function() {
            setTimeout(() => {
                this.isCopied = false;
            }, 5000);
        }
    }
}
</script>
