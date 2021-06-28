<template>
    <div class="px-10 md:px-20">
        <div class="w-100 xl:w-8/12">
            <form action="/dashboard/manufacturer/store" method="POST" class="w-full my-2" id="manufacturerCreateForm" enctype="multipart/form-data">
                <input type="hidden" name="_token" :value="csrf">
                <div class="flex flex-column xl:flex-row xl:space-x-5">
                    <div class="w-100 xl:w-4/12 mb-3 xl:m-0">
                        <p class="text-gray-800 font-medium text-sm md:text-base xl:text-lg">Name</p>
                    </div>
                    <div class="w-100 xl:w-8/12">
                        <div class="col-span-6 relative">
                            <input v-model.trim="$v.fields.name.$model" :class='{ "border-2 border-red-500 animate__animated animate__shakeX" : submitted && !$v.fields.name.required}' placeholder="Sony, Volvo, Logitech etc." name="name" id="name" type="text" class="appearance-none block border border-gray-200 p-2 rounded-md w-full shadow-sm focus:border-indigo-500 focus:outline-none" autofocus>

                            <div class="absolute inset-y-7 top-0 right-0 pr-3 flex items-center pointer-events-none" v-if="!$v.fields.name.required">
                                <svg v-if="submitted && !$v.fields.name.required" class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <p class="error text-red-500 mt-2" v-if="submitted && !$v.fields.name.required">Naam is verplicht!</p>
                        </div>

                    </div>
                </div>
                <hr class="my-4">
                <div class="flex flex-column xl:flex-row xl:space-x-5">
                    <div class="w-100 xl:w-4/12 mb-3 xl:m-0">
                        <p class="text-gray-800 font-medium text-base xl:text-lg">Address</p>
                    </div>
                    <div class="w-100 xl:w-8/12">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 relative">
                                <label for="street_address" class="block text-sm font-medium text-gray-700">Street address</label>
                                <input type="text" v-model.trim="$v.fields.street_address.$model" name="street_address" :class="{ 'border-red-500 animate__animated animate__shakeX' : submitted && !$v.fields.street_address.required}" id="street_address" autocomplete="street-address" class="appearance-none block border border-gray-200 p-2 rounded-md w-full shadow-sm focus:border-indigo-500 focus:outline-none">

                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none" v-if="!$v.fields.street_address.required">
                                    <svg v-if="submitted && !$v.fields.street_address.required" class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <p class="error text-red-500 mt-2" v-if="submitted && !$v.fields.street_address.required">Address is verplicht!</p>
                            </div>

                            <div class="col-span-6 sm:col-span-6 lg:col-span-2 relative">
                                <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                                <input type="text" v-model.trim="$v.fields.city.$model" name="city" :class="{'border-red-500 animate__animated animate__shakeX' : submitted && !$v.fields.city.required}" id="city" class="appearance-none block border border-gray-200 p-2 rounded-md w-full shadow-sm focus:border-indigo-500 focus:outline-none">

                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none" v-if="!$v.fields.city.required">
                                    <svg v-if="submitted && !$v.fields.city.required" class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <p class="error text-red-500 mt-2" v-if="submitted && !$v.fields.city.required">City is verplicht!</p>
                            </div>

                            <div class="col-span-6 sm:col-span-3 lg:col-span-2 relative">
                                <label for="state" class="block text-sm font-medium text-gray-700">State / Province</label>
                                <input type="text" v-model.trim="$v.fields.state.$model" name="state" :class="{ 'border-red-500 animate__animated animate__shakeX' : submitted && !$v.fields.state.required}" id="state" class="appearance-none block border border-gray-200 p-2 rounded-md w-full shadow-sm focus:border-indigo-500 focus:outline-none">

                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none" v-if="!$v.fields.state.required">
                                    <svg v-if="submitted && !$v.fields.state.required" class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <p class="error text-red-500 mt-2" v-if="submitted && !$v.fields.state.required">State is verplicht!</p>
                            </div>

                            <div class="col-span-6 sm:col-span-3 lg:col-span-2 relative">
                                <label for="postal_code" class="block text-sm font-medium text-gray-700">ZIP / Postal</label>
                                <input type="text" v-model.trim="$v.fields.postal_code.$model" name="postal_code" :class="{ 'border-red-500 animate__animated animate__shakeX' : submitted && !$v.fields.postal_code.required}" id="postal_code" autocomplete="postal-code" class="appearance-none block border border-gray-200 p-2 rounded-md w-full shadow-sm focus:border-indigo-500 focus:outline-none">

                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none" v-if="!$v.fields.postal_code.required">
                                    <svg v-if="submitted && !$v.fields.postal_code.required" class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <p class="error text-red-500 mt-2" v-if="submitted && !$v.fields.postal_code.required">Postal code is verplicht!</p>
                            </div>

                            <div class="col-span-6 relative">
                                <label for="country" class="block text-sm font-medium text-gray-700">Country / Region</label>
                                <select id="country" v-model.trim="$v.fields.country.$model" name="country" :class="{ 'border-red-500 animate__animated animate__shakeX' : submitted && !$v.fields.country.required}" autocomplete="country" class="appearance-none block border border-gray-200 p-2 rounded-md w-full shadow-sm focus:border-indigo-500 focus:outline-none">
                                    <option v-for="country in countries" :value="country.id">{{ country.name }}</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none" v-if="!$v.fields.country.required">
                                    <svg v-if="submitted && !$v.fields.country.required" class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <p class="error text-red-500 mt-2" v-if="submitted && !$v.fields.country.required">Country is verplicht!</p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-4">
                <div class="flex flex-column xl:flex-row xl:space-x-5">
                    <div class="w-100 xl:w-4/12 mb-3 xl:m-0">
                        <p class="text-gray-800 font-medium text-sm md:text-base xl:text-lg">Logo</p>
                    </div>
                    <div class="w-100 xl:w-8/12">
                        <div class="space-y-2">
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="logo-upload" class="relative cursor-pointer rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                            <span>Upload a file</span>
                                            <input id="logo-upload" v-on:change="onLogoChanged" name="logo_upload" type="file" accept="image/*" class="sr-only">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">
                                        PNG, JPG, GIF up to 10MB
                                    </p>
                                </div>
                            </div>
                            <uploadedFiles v-if="this.fields.thumbnail" :file.sync="fields.thumbnail"></uploadedFiles>
                        </div>
                    </div>
                </div>
                <hr class="my-4">
                <div class="flex flex-column xl:flex-row xl:space-x-5">
                    <div class="w-100 xl:w-4/12 mb-3 xl:m-0">
                        <p class="text-gray-800 font-medium text-sm md:text-base xl:text-lg">Description</p>
                    </div>
                    <div class="w-100 xl:w-8/12">
                        <textarea v-model="fields.description" id="description" name="description" rows="5" class="p-2 shadow-sm block w-full border border-gray-200 rounded-md" placeholder="Write something beautiful"></textarea>
                    </div>
                </div>
                <div class="flex flex-column-reverse xl:flex-row space-y-5 xl:space-y-0 xl:float-right my-10 xl:space-x-5">
                    <a href="/dashboard/manufacturers" class="w-full xl:w-auto inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 mt-2 xl:mt-0 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:w-auto sm:text-sm">
                        Cancel
                    </a>
                    <button @click.prevent="submitForm" type="submit" class="w-full xl:w-auto bg-indigo-500 rounded-md p-2 px-4 text-center text-white hover:no-underline hover:bg-indigo-700 transition">Create manufacturer</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import { required } from "vuelidate/lib/validators";
import uploadedFiles from '../imageUpload/uploadedFileComponent'

export default {
    data () {
        return {
            fields: {
                name: '',
                street_address: '',
                city: '',
                country: '',
                state: '',
                postal_code: '',
                description: '',
                thumbnail: '',
                thumbnailPreview: null,
            },
            countries: [],
            submitted: false,
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        };
    },
    components: {
        uploadedFiles
    },
    mounted() {
        this.getAllCountries()
    },
    methods: {
        getAllCountries: function() {
            axios.get('/api/get/all/countries')
                .then(response => {
                    this.countries = response.data
                }).catch(err => {
                console.log("There has been an error getting all countries")
            });
        },
        onLogoChanged (event) {
            const file = event.target.files[0];
            this.fields.thumbnail = file;
            this.fields.thumbnailPreview = URL.createObjectURL(file);
        },
        submitForm: function() {
            this.submitted = true
            this.$v.$touch()

            if(this.$v.$error) {
                return
            } else {
                document.getElementById("manufacturerCreateForm").submit();
            }
        },
    },
    validations: {
        fields: {
            name: {
                required
            },
            street_address: {
                required
            },
            city: {
                required
            },
            country: {
                required
            },
            state: {
                required
            },
            postal_code: {
                required
            },
        }
    }
}
</script>
