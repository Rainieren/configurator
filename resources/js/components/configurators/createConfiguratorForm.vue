<template>
    <div class="px-20">
        <div class="flex space-x-10">
            <div class="w-6/12">
                <form action="/dashboard/configurator/store" method="POST" class="w-full my-2" id="configuratorCreateForm" enctype="multipart/form-data">
                    <input type="hidden" name="_token" :value="csrf">
                    <div class="flex space-x-5">
                        <div class="w-4/12">
                            <p class="text-gray-800 font-medium text-lg">Name</p>
                        </div>
                        <div class="w-8/12">
                            <div class="relative">
                                <input v-model.trim="$v.fields.name.$model" name="name" id="name" type="text" :class="{'border-red-600': submitted && !$v.fields.name.required || !$v.fields.name.maxLength}" class="appearance-none block border border-gray-200 p-2 rounded-md w-full shadow-sm focus:border-indigo-500 focus:outline-none" autofocus>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none" v-if="!$v.fields.name.required">
                                    <svg v-if="submitted && !$v.fields.name.required" class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            <p class="error text-red-600 my-3" v-if="submitted && !$v.fields.name.required">Naam is verplicht!</p>
                            <p class="error text-red-600 my-3" v-if="submitted && !$v.fields.name.maxLength">Naam mag niet meer dan 128 Karakters bevatten!</p>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="flex space-x-5">
                        <div class="w-4/12">
                            <p class="text-gray-800 font-medium text-lg">Theme color</p>
                        </div>
                        <div class="w-8/12">
                            <div class="flex space-x-5">
                                <div class="block h-10 w-10 rounded-md" :style="{backgroundColor: this.fields.themeColor}"></div>
                                <div class="relative w-100">
                                    <input v-model="fields.themeColor" name="theme_color" id="theme_color" placeholder="Click me" type="color" :class="{'border-red-600': submitted && !$v.fields.themeColor.required}" class="appearance-none block p-2 h-100 rounded-md w-full shadow-sm">
                                </div>
                            </div>
                            <fieldset>
                                <div class="flex items-center my-5">
                                    <div class="flex items-center h-5">
                                        <div class="flex justify-between items-center" @click="[fields.themeColor != fields.defaultColor ? fields.themeColor = fields.defaultColor : fields.themeColor = '#000000']">
                                            <div class="w-12 h-7 flex items-center bg-gray-200 rounded-full p-1 duration-300 ease-in-out" :class="{ 'bg-green-500': fields.themeColor === fields.defaultColor}">
                                                <div class="bg-white w-5 h-5 rounded-full shadow-md transform duration-300 ease-in-out" :class="{ 'translate-x-5': fields.themeColor === fields.defaultColor}"></div>
                                            </div>
                                        </div>
                                        <input id="allow_multiple" name="allow_multiple" type="hidden" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <label for="allow_multiple" class="font-medium text-gray-700">Use default</label>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="flex space-x-5">
                        <div class="w-4/12">
                            <p class="text-gray-800 font-medium text-lg">Language</p>
                        </div>
                        <div class="w-8/12">
                            <div class="relative">
                                <select v-model.trim="$v.fields.language.$model" type="text" :class="{'border-red-600': submitted && !$v.fields.language.required}" name="interaction_type" id="interaction_type" class="appearance-none block border border-gray-200 p-2 rounded-md w-full shadow-sm focus:border-indigo-500 focus:outline-none">
                                    <option value="" selected>Kies een interactie type</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none" v-if="!$v.fields.language.required">
                                    <svg v-if="submitted && !$v.fields.language.required" class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            <p class="error text-red-600 my-3" v-if="submitted && !$v.fields.language.required">Interactie type is verplicht!</p>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="flex space-x-5">
                        <div class="w-4/12">
                            <p class="text-gray-800 font-medium text-lg">Thumbnail</p>
                            <p class="text-gray-500">Upload a thumbnail of the configurator</p>
                        </div>
                        <div class="w-8/12">
                            <div>
                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600">
                                            <label for="thumbnail_upload" class="relative cursor-pointer rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                <span>Upload a file</span>
                                                <input id="thumbnail_upload" v-on:change="onThumbnailChanged" name="thumbnail_upload" type="file" accept="image/*" class="sr-only">
                                            </label>
                                            <p class="pl-1">or drag and drop</p>
                                        </div>
                                        <p class="text-xs text-gray-500">
                                            PNG, JPG, GIF up to 10MB
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="flex space-x-5">
                        <div class="w-4/12">
                            <p class="text-gray-800 font-medium text-lg">Parent products</p>
                            <p class="text-gray-500">Which products would you like to add to this configurator?</p>
                        </div>
                        <div class="w-8/12">
                            <fieldset>
                                <div class="space-y-4">
                                    <div class="flex" v-for="product in configurableProducts">
                                        <div class="flex items-center justify-center">
                                            <div class="flex items-center h-5">
                                                <div class="flex justify-between items-center" @click="()=>{AddSelectedConfigurableProducts(product.id)}">
                                                    <div class="w-12 h-7 flex items-center bg-gray-200 rounded-full p-1 duration-300 ease-in-out" :class="{ 'bg-green-500': selectedConfigurableProducts.includes(product.id)}">
                                                        <div class="bg-white w-5 h-5 rounded-full shadow-md transform duration-300 ease-in-out" :class="{ 'translate-x-5': selectedConfigurableProducts.includes(product.id)}"></div>
                                                    </div>
                                                </div>
                                                <input v-model="fields.is_optional" id="is_optional" name="is_optional" type="hidden" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                            </div>
                                            <input :id="product.id" :value="product.id" :name="product.id" type="hidden" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                        </div>
                                        <div class="ml-3 flex w-100">
                                            <div class="w-4/6">
                                                <label :for="product.id" class="font-medium text-gray-700 m-0">{{ product.name }}</label>
                                                <label :for="product.id" class="text-gray-500 block">{{ product.description | truncate(32) }}</label>
                                            </div>
                                            <div class="w-2/6 flex items-center justify-end">
                                                <label :for="product.id">{{ product.price | currency('€ ')}}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <div class="flex float-right my-5 space-x-5">
                        <button type="button" class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Cancel
                        </button>
                        <button @click.prevent="submitConfiguratorForm" type="submit" class="bg-indigo-500 rounded p-2 w-48 text-center text-white hover:no-underline hover:bg-indigo-500 transition">Create configurator</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import {maxLength, minValue, required, requiredIf} from "vuelidate/lib/validators";

export default {
    data () {
        return {
            fields: {
                name: '',
                language: 1,
                themeColor: '#6366F1',
                thumbnail: '',
                thumbnailPreview: null,
                defaultColor: '#6366F1',
            },
            configurableProducts: [],
            selectedConfigurableProducts: [],
            submitted: false,
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        };
    },
    mounted: function() {
        this.getConfigurableProductsWithNoConfigurator();
    },
    computed: {
        backgroundColor() {

        }
    },
    methods: {
        submitConfiguratorForm: function() {
            this.submitted = true
            this.$v.$touch()

            if(this.$v.$error) {
                return
            } else {
                document.getElementById("configuratorCreateForm").submit();
            }
        },
        onThumbnailChanged (event) {
            const file = event.target.files[0];
            this.fields.thumbnail = file;
            this.fields.thumbnailPreview = URL.createObjectURL(file);
        },
        AddSelectedConfigurableProducts: function(id) {
            if(this.selectedConfigurableProducts.includes(id)){
                this.selectedConfigurableProducts=_.without(this.selectedConfigurableProducts,id)
            } else{
                this.selectedConfigurableProducts.push(id)
            }
        },
        getConfigurableProductsWithNoConfigurator: function() {
            axios.get('/api/get/configurable_products_with_no_configurator')
                .then(response => {
                    this.configurableProducts = response.data
                }).catch(err => {
                console.log(err)
            });
        },
    },
    validations: {
        fields: {
            name: {
                required,
                maxLength: maxLength(128)
            },
            language: {
                required,
            },
            themeColor: {
                required,
            }
        }
    }
}
</script>
