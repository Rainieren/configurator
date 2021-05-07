<template>
    <div class="p-5">
        <div class="flex space-x-10">
            <div class="w-6/12">
                <form action="/dashboard/step/store" method="POST" class="w-full my-2" id="productCreateForm">
                    <div class="flex space-x-5">
                        <div class="w-4/12">
                            <p class="text-gray-800 font-medium text-lg">Name</p>
                        </div>
                        <div class="w-8/12">
                            <input name="name" id="name" type="text" class="p-2 border border-gray-500 rounded-md w-100 shadow-sm">
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="flex space-x-5">
                        <div class="w-4/12">
                            <p class="text-gray-800 font-medium text-lg">Step type</p>
                            <p class="text-gray-500">How do you want the useers to interact with this step. This will only allow products to be added with the selected interaction type</p>
                        </div>
                        <div class="w-8/12">
                            <select v-model="fields.interactionType" type="text" name="input_field_type" id="input_field_type" class="p-2 border border-gray-500 rounded-md w-100 shadow-sm">
                                <option v-for="type in stepTypes" :value="type.id">{{ type.name }}</option>
                            </select>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="flex space-x-5">
                        <div class="w-4/12">
                            <p class="text-gray-800 font-medium text-lg">Add a product</p>
                            <p class="text-gray-500">Which products would you like to add to this step? </p>
                        </div>
                        <div class="w-8/12">
                            <div class="">
                                <a href="#" @click="openModal">
                                    <div class="border-2 border-dashed border-gray-400 hover:border-indigo-500 hover:text-indigo-500 h-32 w-100  flex-column rounded-md flex justify-center items-center transition">
                                        <p>Add a product</p>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="flex float-right my-5 space-x-5">
                        <a href="" class="bg-gray-300 rounded p-2 text-centet text-black hover:text-indigo-500 hover:no-underline transition">Cancel</a>
                        <button type="submit" class="bg-indigo-500 rounded p-2 w-48 text-center text-white hover:no-underline hover:bg-indigo-700 transition">Create step</button>
                    </div>
                </form>
            </div>
        </div>
        <modal ref="modal" :interaction-type="fields.interactionType" :selected-products="selectedProducts"></modal>
    </div>
</template>

<script>
    import Modal from "./modalComponent";

    export default {
        data () {
            return {
                fields: {
                    interactionType: 1,
                },
                selectedProducts: {
                    'id': '1',
                    'name': "hoi"
                },
                stepTypes: {},
            };
        },
        mounted: function() {
            this.getStepTypes();
        },
        components: {
            Modal
        },
        methods: {
            openModal() {
                this.$refs.modal.showModal = true;
            },
            getStepTypes() {
                axios.get('/api/get/step_types')
                    .then(response => {
                        this.stepTypes = response.data
                    }).catch(err => {
                        console.log(err)
                });
            }
        },
    }
</script>
