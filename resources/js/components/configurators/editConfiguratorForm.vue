<template>
    <div class="">

        <div class="px-20 pt-10 pb-10">
            <div class="flex">
                <div class="w-1/2 flex items-center">
                    <p class="text-3xl font-bold text-gray-900">{{ this.fields.name }}</p>
                </div>
            </div>
        </div>
        <div class="px-20">
            <div class="flex space-x-10">
                <div class="w-6/12">
                    <form class="w-full my-2" id="configuratorCreateForm">
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
                        <div class="flex float-right my-5 space-x-5">
                            <button type="button" class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Cancel
                            </button>
                            <button @click.prevent="updateConfigurator" type="submit" class="bg-indigo-500 rounded p-2 w-48 text-center text-white hover:no-underline hover:bg-indigo-500 transition">Update configurator</button>
                        </div>
                    </form>
                </div>
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
                name: this.configurator.name,
                themeColor: this.configurator.theme_color,
                defaultColor: '#6366F1',
            },
            submitted: false,
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        };
    },
    props: ['configurator'],
    methods: {
        updateConfigurator: function() {
            this.submitted = true
            this.$v.$touch()

            if(this.$v.$error) {
                return
            } else {
                axios.patch('/api/configurator/' + this.configurator.id + '/update', {
                    data: {
                        fields: this.fields,
                    },
                    headers: { "X-Requested-With": "XMLHttpRequest","Content-Type": "application/json" }
                }).then(response => {
                    this.loading = false
                    window.location = "/dashboard/configurators"
                }).catch(err => {
                    console.log(err)
                });
            }
        }
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
