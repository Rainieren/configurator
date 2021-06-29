<template>
    <div class="">

        <div class="px-10 py-5 md:px-20 md:py-10 transition-all">
            <div class="flex">
                <div class="w-1/2 flex items-center">
                    <p class="text-base md:text-lg lg:text-2xl xl:text-3xl font-extrabold text-gray-900">{{ this.fields.name }}</p>
                </div>
            </div>
        </div>
        <div class="px-10 md:px-20">
            <div class="flex flex-column xl:flex-row xl:space-x-10">
                <div class="w-100 xl:w-8/12">
                    <form :action="'/dashboard/configurator/' + this.configurator.id + '/update'" method="POST" class="w-full my-2" id="configuratorEditForm" enctype="multipart/form-data">
                        <input type="hidden" name="_token" :value="csrf">
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="flex flex-column xl:flex-row xl:space-x-5">
                            <div class="w-100 xl:w-4/12 mb-3 xl:m-0">
                                <p class="text-gray-800 font-medium text-sm md:text-base xl:text-lg">Name</p>
                            </div>
                            <div class="w-100 xl:w-8/12">
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
                        <div class="flex flex-column xl:flex-row xl:space-x-5">
                            <div class="w-100 xl:w-4/12 mb-3 xl:m-0">
                                <p class="text-gray-800 font-medium text-sm md:text-base xl:text-lg">Theme color</p>
                            </div>
                            <div class="w-100 xl:w-8/12">
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
                                            <input id="default_color" name="default_color" type="hidden" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="default_color" class="font-medium text-gray-700">Use default</label>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="flex flex-column xl:flex-row xl:space-x-5">
                            <div class="w-100 xl:w-4/12 mb-3 xl:m-0">
                                <p class="text-gray-800 font-medium text-sm md:text-base xl:text-lg">Thumbnail</p>
                                <p class="text-gray-500">Upload a thumbnail of the configurator</p>
                            </div>
                            <div class="w-100 xl:w-8/12">
                                <div class="space-y-2">
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
                                    <uploadedFiles v-if="this.fields.thumbnail" :file.sync="fields.thumbnail"></uploadedFiles>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-column-reverse xl:flex-row space-y-5 xl:space-y-0 xl:float-right my-10 xl:space-x-5">
                            <a href="/dashboard/configurators" type="button" class="w-full xl:w-auto inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 mt-2 xl:mt-0 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:w-auto sm:text-sm">
                                Cancel
                            </a>
                            <button @click.prevent="updateConfigurator" type="submit" class="w-full bg-indigo-500 rounded p-2 px-4 w-48 text-center text-white hover:no-underline hover:bg-indigo-500 transition">Update configurator</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import {maxLength, minValue, required, requiredIf} from "vuelidate/lib/validators";
import uploadedFiles from '../imageUpload/uploadedFileComponent'

export default {
    data () {
        return {
            fields: {
                name: this.configurator.name,
                themeColor: this.configurator.theme_color,
                defaultColor: '#6366F1',
                thumbnail: this.configurator.thumbnail,
                thumbnailPreview: null,
                selectedConfigurableProducts: [],
            },
            submitted: false,
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        };
    },
    components: {
        uploadedFiles
    },
    props: ['configurator'],
    methods: {
        updateConfigurator: function() {
            this.submitted = true
            this.$v.$touch()

            if(this.$v.$error) {
                return
            } else {
                document.getElementById("configuratorEditForm").submit();
                // let form = new FormData();
                // form.set('file', this.fields.thumbnail);
                // axios.patch('/api/configurator/' + this.configurator.id + '/update', {
                //     data: {
                //         fields: this.fields,
                //         file: this.fields.thumbnail
                //     },
                // }).then(response => {
                //     this.loading = false
                //     // window.location = "/dashboard/configurators"
                // }).catch(err => {
                //     console.log(err)
                // });
            }
        },
        onThumbnailChanged (event) {
            const file = event.target.files[0];
            this.fields.thumbnail = file;
            this.fields.thumbnailPreview = URL.createObjectURL(file);
        },
    },
    validations: {
        fields: {
            name: {
                required,
                maxLength: maxLength(128)
            },
            themeColor: {
                required,
            }
        }
    }
}
</script>
