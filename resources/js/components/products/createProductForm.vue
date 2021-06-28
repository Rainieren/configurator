<template>
    <div class="px-10 md:px-20">
        <div class="flex flex-column xl:flex-row xl:space-x-10">
            <div class="w-100 xl:w-8/12">
                <form action="/dashboard/product/store" method="POST" enctype="multipart/form-data" class="w-full my-2" id="productCreateForm" >
                    <input type="hidden" name="_token" :value="csrf">
                    <div class="flex flex-column xl:flex-row xl:space-x-5">
                        <div class="w-100 xl:w-4/12 mb-3 xl:m-0">
                            <p class="text-gray-800 font-medium text-sm md:text-base xl:text-lg">Name</p>
                        </div>
                        <div class="w-100 xl:w-8/12 ">
                            <div class="relative">
                                <input v-model.trim="$v.fields.name.$model" :class="{'border-red-600 animate__animated animate__shakeX': submitted && !$v.fields.name.required || !$v.fields.name.maxLength }" name="name"  class="appearance-none block border border-gray-200 p-2 rounded-md w-full shadow-sm focus:border-indigo-500 focus:outline-none" id="name" type="text" autofocus>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none" v-if="!$v.fields.name.required">
                                    <svg v-if="submitted && !$v.fields.name.required" class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            <p class="error text-red-600 my-3" v-if="submitted && !$v.fields.name.required">Name is required!</p>
                            <p class="error text-red-600 my-3" v-if="submitted && !$v.fields.name.maxLength">Name cannot have more than 128 Characters!</p>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="flex space-x-5">
                        <div class="w-1/2 xl:w-4/12">
                            <p class="text-gray-800 font-medium text-sm md:text-base xl:text-lg">Enable product</p>
                        </div>
                        <div class="w-1/2 xl:w-8/12">
                            <fieldset>
                                <div class="flex items-center justify-end xl:justify-start">
                                    <div class="flex items-center h-5">
                                        <div class="flex justify-between items-center" @click="[fields.isEnabled = !fields.isEnabled]">
                                            <div class="w-12 h-7 flex items-center bg-gray-200 rounded-full p-1 duration-300 ease-in-out" :class="{ 'bg-green-500': fields.isEnabled}">
                                                <div class="bg-white w-5 h-5 rounded-full shadow-md transform duration-300 ease-in-out" :class="{ 'translate-x-5': fields.isEnabled,}"></div>
                                            </div>
                                        </div>
                                        <input v-model="fields.isEnabled" id="enable_product" name="isEnabled" type="hidden" class="focus:ring-indigo-500 h-4 w-4 form-checkbox text-indigo-500 border-gray-200 focus:bg-indigo-500 rounded">
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <label for="configurable_product" class="font-medium text-gray-700 m-0">Enabled</label>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="flex space-x-5">
                        <div class="w-1/2 xl:w-4/12">
                            <p class="text-gray-800 font-medium text-sm md:text-base xl:text-lg">Visibility</p>
                        </div>
                        <div class="w-1/2 xl:w-8/12">
                            <fieldset>
                                <div class="flex items-center justify-end xl:justify-start">
                                    <div class="flex items-center h-5">
                                        <div class="flex justify-between items-center" @click="[fields.isVisible = !fields.isVisible]">
                                            <div class="w-12 h-7 flex items-center bg-gray-200 rounded-full p-1 duration-300 ease-in-out" :class="{ 'bg-green-500': fields.isVisible}">
                                                <div class="bg-white w-5 h-5 rounded-full shadow-md transform duration-300 ease-in-out" :class="{ 'translate-x-5': fields.isVisible,}"></div>
                                            </div>
                                        </div>
                                        <input v-model="fields.isVisible" id="visibility_product" name="isVisible" type="hidden" class="focus:ring-indigo-500 h-4 w-4 form-checkbox text-indigo-500 border-gray-200 focus:bg-indigo-500 rounded">
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <label for="configurable_product" class="font-medium text-gray-700 m-0">Enabled</label>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="flex space-x-5 mt-10">
                        <div class="w-8/12">
                            <p class="text-gray-800 font-medium  text-base xl:text-lg">General information</p>
                            <p class="text-gray-400 font-medium">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque eius eos facilis id illum in ipsa iste libero nostrum, nulla officia repellendus repudiandae similique sit, totam veniam vero? Rem, rerum.</p>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="flex flex-column md:flex-row md:space-x-5 space-y-5 md:space-y-0">
                        <div class="w-100 md:w-4/12">
                            <p class="text-gray-800 font-medium text-sm md:text-base xl:text-lg">Configurable product</p>
                        </div>
                        <div class="w-100 md:w-8/12">
                            <fieldset class="">
                                <div class="flex items-center">
                                    <div class="flex items-center h-5">
                                        <div class="flex justify-between items-center" @click="[fields.isConfigurableProduct = !fields.isConfigurableProduct], isConfigurableProductFunc()">
                                            <div class="w-12 h-7 flex items-center bg-gray-200 rounded-full p-1 duration-300 ease-in-out" :class="{ 'bg-green-500': fields.isConfigurableProduct}">
                                                <div class="bg-white w-5 h-5 rounded-full shadow-md transform duration-300 ease-in-out" :class="{ 'translate-x-5': fields.isConfigurableProduct,}"></div>
                                            </div>
                                        </div>
                                        <input v-model="fields.isConfigurableProduct" id="configurable_product" name="configurable_product" type="hidden" class="focus:ring-indigo-500 h-4 w-4 form-checkbox text-indigo-500 border-gray-200 focus:bg-indigo-500 rounded">
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <label for="configurable_product" class="font-medium text-gray-700 m-0">This product is a configurable product</label>
                                    </div>
                                </div>
                            </fieldset>
                            <div v-if="fields.isConfigurableProduct" class="mt-5">
                                <label for="height" class="font-medium text-gray-700">Configurator</label>
                                <select v-model.trim="$v.fields.configurator_id.$model" :class="{'border-red-500 animate__animated animate__shakeX': submitted && !$v.fields.configurator_id.required}" type="text" name="configurator" id="configurator" class="appearance-none block border border-gray-200 p-2 rounded-md w-full shadow-sm focus:border-indigo-500 focus:outline-none">
                                    <option :value="configurator.id" selected v-for="configurator in configurators">{{ configurator.name }}</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none" v-if="!$v.fields.stock.required">
                                    <svg v-if="submitted && !$v.fields.configurator_id.required" class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <p class="error text-red-600 my-3" v-if="submitted && !$v.fields.configurator_id.required">Configurator is required!</p>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="flex flex-column xl:flex-row xl:space-x-5">
                        <div class="w-100 xl:w-4/12 mb-3 xl:m-0">
                            <p class="text-gray-800 font-medium text-sm md:text-base xl:text-lg">Price</p>
                        </div>
                        <div class="w-100 xl:w-8/12 ">
                            <div class="relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                  <span class="text-gray-500 sm:text-sm">
                                    €
                                  </span>
                                </div>
                                <input :maxlength="8" v-model.trim="$v.fields.price.$model" v-mask="mask" :class="{ 'border-red-500 animate__animated animate__shakeX' : submitted && !$v.fields.price.required}" type="text" name="price" id="price" class="appearance-none block border border-gray-200 pl-8 p-2 rounded-md w-full shadow-sm focus:border-indigo-500 focus:outline-none" placeholder="0.00" :disabled="fields.hasPriceIncrease">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none" v-if="!$v.fields.price.required">
                                    <svg v-if="submitted && !$v.fields.price.required" class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            <p class="error text-red-600 my-3" v-if="submitted && !$v.fields.price.required">Price is required!</p>

                            <div class="" v-if="!fields.isConfigurableProduct">
                                <fieldset>
                                    <div class="mt-3 space-y-2">
                                        <div class="flex items-center">
                                            <div class="flex items-center">
                                                <div class="flex justify-between items-center" @click="[fields.hasPriceIncrease = !fields.hasPriceIncrease], priceIncreaseFunc()">
                                                    <div class="w-12 h-7 flex items-center bg-gray-200 rounded-full p-1 duration-300 ease-in-out" :class="{ 'bg-green-500': fields.hasPriceIncrease}">
                                                        <div class="bg-white w-5 h-5 rounded-full shadow-md transform duration-300 ease-in-out" :class="{ 'translate-x-5': fields.hasPriceIncrease,}"></div>
                                                    </div>
                                                </div>
                                                <input v-model="fields.hasPriceIncrease" id="price_increase" name="price_increase" type="hidden" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-200 rounded">
                                            </div>
                                            <div class="ml-3 text-sm">
                                                <label for="price_increase" class="font-medium text-gray-700">This product has a price increase</label>
                                                <p class="text-gray-500">Select this option if the product should increase the price with a percentage</p>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <div v-if="fields.hasPriceIncrease">
                                    <div class="my-3">
                                        <label for="percentage" class="font-medium text-gray-700 text-sm md:text-base xl:text-lg">Percentage</label>
                                        <div class="relative flex mt-1 w-100 xl:w-25">

                                            <input v-mask="'###'" v-model.trim="$v.fields.priceIncrease.$model" :maxlength="6" :class="{ 'border-red-500 animate__animated animate__shakeX' : submitted && $v.fields.priceIncrease.$error}" type="text" name="percentage" id="percentage" class="appearance-none block border border-gray-200 p-2 rounded-l-md w-full shadow-sm focus:border-indigo-500 focus:outline-none" placeholder="">
                                            <span class="inline-flex items-center px-3 rounded-r-md border border-l-0 border-gray-200 bg-gray-50 text-gray-500 text-sm shadow-sm">
                                                %
                                            </span>
                                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none" v-if="!$v.fields.priceIncrease.required">
                                                <svg v-if="submitted && !$v.fields.priceIncrease.required" class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </div>
                                        <p class="error text-red-600 my-3" v-if="submitted && !$v.fields.priceIncrease.required">Percentage is required!</p>
                                    </div>
                                    <div class="my-3">
                                        <label for="percentage" class="font-medium text-gray-700 text-sm md:text-base xl:text-lg">The percentage needs to be based on the price of a parent product:</label>
                                        <fieldset class="my-3">
                                            <div class="space-y-4">
                                                <div class="flex" v-for="product in configurableProducts">
                                                    <div class="flex items-center justify-center ">
                                                        <input v-model.trim="$v.fields.percentageParentProduct.$model" type="radio" name="percentageParentProduct" :class="{ 'border-red-500 animate__animated animate__shakeX' : submitted && !$v.fields.percentageParentProduct.required}" :value="product.price" class="mr-3 form-radio focus:ring-indigo-500 h-4 w-4 text-indigo-600 border border-gray-300">
                                                    </div>
                                                    <div class="ml-3 flex w-100">
                                                        <div class="w-4/6">
                                                            <label class="font-medium text-gray-700 m-0" for="percentageParentProduct">{{ product.name }}</label>
                                                        </div>
                                                        <div class="w-2/6 text-right">
                                                            <label class="font-medium text-gray-700 m-0">{{ product.price | currency('€ ') }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="error text-red-600 my-3" v-if="submitted && !$v.fields.percentageParentProduct.required">Select a parent product!</p>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="flex flex-column xl:flex-row xl:space-x-5">
                        <div class="w-100 xl:w-4/12 mb-3 xl:m-0">
                            <p class="text-gray-800 font-medium text-sm md:text-base xl:text-lg">SKU</p>
                        </div>
                        <div class="w-100 xl:w-8/12">
                            <div class="relative">
                                <input v-model.trim="$v.fields.sku.$model" type="text" id="sku" name="sku" maxlength="191"  :class="{ 'border-red-500 animate__animated animate__shakeX' : submitted && !$v.fields.sku.required}" class="appearance-none block border border-gray-200 p-2 rounded-md w-full shadow-sm focus:border-indigo-500 focus:outline-none">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none" v-if="!$v.fields.sku.required">
                                    <svg v-if="submitted && !$v.fields.sku.required" class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            <p class="error text-red-600 my-3" v-if="submitted && !$v.fields.sku.required">SKU is required!</p>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="flex flex-column xl:flex-row xl:space-x-5">
                        <div class="w-100 xl:w-4/12 mb-3 xl:m-0">
                            <p class="text-gray-800 font-medium text-sm md:text-base xl:text-lg">Stock</p>
                        </div>
                        <div class="w-100 xl:w-8/12">
                            <div class="relative">
                                <select v-model.trim="$v.fields.stock.$model" :class="{'border-red-600 animate__animated animate__shakeX': submitted && !$v.fields.stock.required}" type="text" name="stock" id="stock" class="appearance-none block border border-gray-200 p-2 rounded-md w-full shadow-sm focus:border-indigo-500 focus:outline-none">
                                    <option value="1" selected>In stock</option>
                                    <option selected value="0">Out of stock</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none" v-if="!$v.fields.stock.required">
                                    <svg v-if="submitted && !$v.fields.stock.required" class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            <p class="error text-red-600 my-3" v-if="submitted && !$v.fields.stock.required">Stock is required!</p>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="flex flex-column xl:flex-row xl:space-x-5">
                        <div class="w-100 xl:w-4/12 mb-3 xl:m-0">
                            <p class="text-gray-800 font-medium text-sm md:text-base xl:text-lg">Description</p>
                        </div>
                        <div class="w-100 xl:w-8/12">
                            <textarea v-model="fields.description" id="description" name="description" rows="5" class="appearance-none block border border-gray-200 p-2 rounded-md w-full shadow-sm focus:border-indigo-500 focus:outline-none" placeholder="Write something beautiful"></textarea>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="flex flex-column xl:flex-row xl:space-x-5">
                        <div class="w-100 xl:w-4/12 mb-3 xl:m-0">
                            <p class="text-gray-800 font-medium text-sm md:text-base xl:text-lg">Thumbnail</p>
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
                                <uploadedFiles v-if="this.fields.thumbnail" :file.sync="fields.thumbnail" :preview.sync="fields.thumbnailPreview"></uploadedFiles>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="flex flex-column xl:flex-row xl:space-x-5">
                        <div class="w-100 xl:w-4/12 mb-3 xl:m-0">
                            <p class="text-gray-800 font-medium text-sm md:text-base xl:text-lg">Visualisation</p>
                            <p class="text-gray-400">Upload a visualisation of the product</p>
                        </div>
                        <div class="w-100 xl:w-8/12">
                            <div class="space-y-4">
                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600">
                                            <label for="visualisation_upload" class="relative cursor-pointer rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                <span>Upload a file</span>
                                                <input id="visualisation_upload" @change="onVisualisationChanged" name="visualisation_upload" accept="image/*" type="file" class="sr-only">
                                            </label>
                                            <p class="pl-1">or drag and drop</p>
                                        </div>
                                        <p class="text-xs text-gray-500">
                                            PNG, JPG, GIF up to 10MB
                                        </p>
                                    </div>
                                </div>
                                <uploadedFiles v-if="this.fields.visualisation" :file.sync="fields.visualisation"></uploadedFiles>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="flex flex-column xl:flex-row xl:space-x-5">
                        <div class="w-100 xl:w-4/12 mb-3 xl:m-0">
                            <p class="text-gray-800 font-medium text-base xl:text-lg">Product attributes</p>
                            <p class="text-gray-400">These values are configured in settings. To change to another unit of measurement. Go to settings</p>
                        </div>
                        <div class="w-100 xl:w-8/12">
                            <div class="mb-3 w-100 xl:w-2/4">
                                <label for="weight" class="font-medium text-gray-700 text-sm">Weight</label>
                                <div class="relative">
                                    <input v-model="fields.weight" type="text" name="weight" :maxlength="10" v-on:keypress="isLetter($event)" id="weight" class="appearance-none block border border-gray-200 p-2 pr-6 rounded-md w-full shadow-sm focus:border-indigo-500 focus:outline-none" placeholder="">
                                    <p class="text-indigo-500 m-0 font-sm absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none font-medium">kg</p>
                                </div>
                            </div>
                            <div class="mb-3 w-100 xl:w-2/4">
                                <label for="height" class="font-medium text-gray-700 text-sm">Height</label>
                                <div class="relative">
                                    <input v-model="fields.height" type="text" name="height" :maxlength="10" v-on:keypress="isLetter($event)" id="height" class="appearance-none block border border-gray-200 p-2 rounded-md w-full shadow-sm focus:border-indigo-500 focus:outline-none" placeholder="">
                                    <p class="text-indigo-500 m-0 font-sm absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none font-medium">cm</p>
                                </div>
                            </div>
                            <div class="mb-3 w-100 xl:w-2/4">
                                <label for="length" class="font-medium text-gray-700 text-sm">Length</label>
                                <div class="relative">
                                    <input v-model="fields.length" type="text" name="length" :maxlength="10" v-on:keypress="isLetter($event)" id="length" class="appearance-none block border border-gray-200 p-2 rounded-md w-full shadow-sm focus:border-indigo-500 focus:outline-none" placeholder="">
                                    <p class="text-indigo-500 m-0 absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none font-medium">cm</p>
                                </div>
                            </div>
                            <div class="mb-3 w-100 xl:w-2/4">
                                <label for="width" class="font-medium text-gray-700 text-sm">Width</label>
                                <div class="relative">
                                    <input v-model="fields.width" type="text" name="width" :maxlength="10" v-on:keypress="isLetter($event)" id="width" class="appearance-none block border border-gray-200 p-2 rounded-md w-full shadow-sm focus:border-indigo-500 focus:outline-none" placeholder="">
                                    <p class="text-indigo-500 m-0 font-sm absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none font-medium">cm</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="flex flex-column xl:flex-row xl:space-x-5">
                        <div class="w-100 xl:w-4/12 mb-3 xl:m-0">
                            <p class="text-gray-800 font-medium text-sm md:text-base xl:text-lg">Set product as new from</p>
                        </div>
                        <div class="w-100 xl:w-8/12">
                            <div class="flex flex-column xl:flex-row">
                                <div class="w-full flex-column">
                                    <input v-model.trim="$v.fields.newFrom.$model" type="date" name="new_from" id="new_from" :class="{'border-red-600 animate__animated animate__shakeX': submitted && !$v.fields.newFrom.required}" class="appearance-none block border border-gray-200 p-2 rounded-md w-full shadow-sm focus:border-indigo-500 focus:outline-none" placeholder="">
                                    <p class="error text-red-600 my-3" v-if="submitted && !$v.fields.newFrom.required">New from is required!</p>
                                </div>
                                <div class="mx-3 my-3 xl:my-0 flex items-center justify-center">
                                    <p class="text-gray-900 font-medium">To</p>
                                </div>
                                <div class="w-full flex-column">
                                    <input v-model.trim="$v.fields.newTo.$model" type="date" name="new_to" id="new_to"  :class="{'border-red-600 animate__animated animate__shakeX': submitted && !$v.fields.newTo.required}" class="appearance-none block border border-gray-200 p-2 rounded-md w-full shadow-sm focus:border-indigo-500 focus:outline-none" placeholder="">
                                    <p class="error text-red-600 my-3" v-if="submitted && !$v.fields.newTo.required">New to is required!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="flex flex-column xl:flex-row xl:space-x-5">
                        <div class="w-100 xl:w-4/12 mb-3 xl:m-0">
                            <p class="text-gray-800 font-medium text-sm md:text-base xl:text-lg">Manufacturer</p>
                            <p class="text-gray-400">Who made the product?</p>
                        </div>
                        <div class="w-100 xl:w-8/12">
                            <div class="relative">
                                <select v-model.trim="$v.fields.manufacturer.$model" :class="{'border-red-600 animate__animated animate__shakeX': submitted && !$v.fields.manufacturer.required}" type="text" name="manufacturer" id="manufacturer" class="appearance-none block border border-gray-200 p-2 rounded-md w-full shadow-sm focus:border-indigo-500 focus:outline-none" :disabled="!fields.hasManufacturer">
                                    <option selected value="">Select a manufacturer</option>
                                    <option :value="manufacturer.id" v-for="manufacturer in manufacturers">{{  manufacturer.name }}</option>
                                </select>

                                <div class="absolute inset-y-2 right-0 pr-3 flex items-start pointer-events-none" v-if="!$v.fields.manufacturer.required">
                                    <svg v-if="submitted && !$v.fields.manufacturer.required" class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <p class="error text-red-600 my-3" v-if="submitted && !$v.fields.manufacturer.required">Manufacturer is required!</p>
                            </div>
                            <fieldset>
                                <div class="mt-3 space-y-2">
                                    <div class="flex items-start">
                                        <div class="flex items-center">
                                            <div class="flex justify-between items-center" @click="[fields.hasManufacturer = !fields.hasManufacturer], fields.manufacturer = ''">
                                                <div class="w-12 h-7 flex items-center bg-gray-200 rounded-full p-1 duration-300 ease-in-out" :class="{ 'bg-green-500': !fields.hasManufacturer}">
                                                    <div class="bg-white w-5 h-5 rounded-full shadow-md transform duration-300 ease-in-out" :class="{ 'translate-x-5': !fields.hasManufacturer}"></div>
                                                </div>
                                            </div>
                                            <input v-model="fields.hasManufacturer" id="has_manufacturer" name="has_manufacturer" type="hidden" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="has_manufacturer" class="font-medium text-gray-700">This product does not have a manufacturer</label>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <div v-if="!fields.isConfigurableProduct">
                        <hr class="my-4">
                        <div class="flex flex-column xl:flex-row xl:space-x-5">
                            <div class="w-100 xl:w-4/12 mb-3 xl:m-0">
                                <p class="text-gray-800 font-medium text-sm md:text-base xl:text-lg">Interaction type</p>
                                <p class="text-gray-400">How do you want user to interact with this product?</p>
                            </div>
                            <div class="w-100 xl:w-8/12">
                                <fieldset>
                                    <div class="space-y-4">

                                        <div class="flex items-center">
                                            <input v-model.trim="$v.fields.interactionType.$model" @click="fields.interactionInputType = ''" id="configuration_card" name="interaction_type" value="1" type="radio" :class="{'border-red-600': submitted && !$v.fields.interactionType.required}" class="mr-3 form-radio focus:ring-indigo-500 h-4 w-4 text-indigo-600 border border-gray-300">
                                            <div class="flex flex-column">
                                                <label for="push_everything" class="block text-sm font-medium text-gray-700 mb-0">
                                                    Card
                                                </label>

                                                <p class="text-gray-400 text-sm font-medium m-0">The product is clickable using a card</p>

                                            </div>

                                        </div>
                                        <div class="flex items-center">
                                            <input v-model.trim="$v.fields.interactionType.$model" id="configuration_input" name="interaction_type" value="3" type="radio" :class="{'border-red-600': submitted && !$v.fields.interactionType.required}" class="mr-3 form-radio focus:ring-indigo-500 h-4 w-4 text-indigo-600 border border-gray-300">
                                            <div class="flex flex-column">
                                                <label for="configuration_input" class="mb-0 block text-sm font-medium text-gray-700">
                                                    Input field
                                                </label>
                                                <p class="text-gray-400 text-sm font-medium m-0">The user can type in what they want</p>
                                            </div>
                                        </div>

                                        <div v-if="fields.interactionType === 'input'" class="my-3">
                                            <label for="input_field_type" class="font-medium text-gray-700">What type of input field?</label>
                                            <select v-model="fields.interactionInputType" type="text" name="input_field_type" id="input_field_type" class="p-2 border border-gray-500 rounded-md w-100 shadow-sm">
                                                <option value="text">Plain text</option>
                                                <option value="date">Date</option>
                                                <option value="passsword">Password</option>
                                            </select>
                                        </div>

                                        <div class="flex items-center">
                                            <input v-model.trim="$v.fields.interactionType.$model"  @click="fields.interactionInputType = ''" id="configuration_radio" name="interaction_type" value="2" type="radio" :class="{'border-red-600': submitted && !$v.fields.interactionType.required}" class="mr-3 form-radio focus:ring-indigo-500 h-4 w-4 text-indigo-600 border border-gray-300">
                                            <div class="flex flex-column">
                                                <label for="configuration_input" class="mb-0 block text-sm font-medium text-gray-700">
                                                    Radio button
                                                </label>
                                                <p class="text-gray-400 text-sm font-medium m-0">The user can select what they want using rounded buttons</p>
                                            </div>
                                        </div>
                                        <p class="error text-red-600 my-3" v-if="submitted && !$v.fields.interactionType.required">Interaction type is required!</p>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-column-reverse xl:flex-row space-y-5 xl:space-y-0 xl:float-right my-10 xl:space-x-5">
                        <a href="/dashboard/products" class="w-full xl:w-auto inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 mt-2 xl:mt-0 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:w-auto sm:text-sm">
                            Cancel
                        </a>
                        <button @click.prevent="submitProductCreateForm" type="submit" class="w-full xl:w-auto bg-indigo-500 rounded-md p-2 px-4 text-center text-white hover:no-underline hover:bg-indigo-700 transition">Create product</button>
                    </div>
                </form>
            </div>
            <div class="w-full xl:w-4/12 relative">
                <div class="sticky top-20  w-full flex items-center flex-column">
                    <p class="font-medium text-2xl mb-3">Preview</p>
                    <product-preview :data="fields"></product-preview>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import createNumberMask from 'text-mask-addons/dist/createNumberMask';
    import productPreview from "./productPreview.vue";
    import radioPreview from "./radioPreview";
    import { required, email, minLength, maxLength, requiredIf, minValue, maxValue } from "vuelidate/lib/validators";
    import uploadedFiles from '../imageUpload/uploadedFileComponent'

    const currencyMask = createNumberMask({
        prefix: '',
        allowDecimal: true,
        decimalSymbol: '.',
        includeThousandsSeparator: true,
        thousandsSeparatorSymbol: ',',
        allowNegative: false,
    });

    export default {
        data () {
            return {
                fields: {
                    name: null,
                    isConfigurableProduct: false,
                    hasPriceIncrease: false,
                    isEnabled: true,
                    isVisible: true,
                    price: null,
                    priceIncrease: null,
                    sku: '',
                    stock: "1",
                    description: '',
                    thumbnail: '',
                    thumbnailPreview: null,
                    visualisation: '',
                    weight: null,
                    length: null,
                    height: null,
                    width: null,
                    newFrom: null,
                    newTo: null,
                    manufacturer: '',
                    hasManufacturer: true,
                    interactionType: null,
                    interactionInputType: '',
                    step: '',
                    configurator_id: '',
                    percentageParentProduct: '',
                },
                mask: currencyMask,
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                manufacturers: {},
                configurators: [],
                configurableProducts: [],
                steps: {},
                submitted: false,
                toggleActive: false,
            };
        },
        components: {
            productPreview,
            radioPreview,
            uploadedFiles
        },
        mounted: function() {
            this.getManufacturers();
            this.getSteps();
            this.getAllConfigurators();
            this.getAllConfigurableProducts();
        },
        computed: {

        },
        methods: {
            updateFiles: function(file, preview) {
                // this.fields.thumbnail = ''
                // this.fields.thumbnailPreview = null
                file = ''
                preview = null
            },
            isConfigurableProductFunc() {
                if(!this.fields.isConfigurableProduct) {
                    this.fields.priceIncrease = null
                    this.fields.hasPriceIncrease = false
                    this.fields.interactionType = null
                    this.fields.interactionInputType = ''
                    this.fields.step = ''
                }
            },
            priceIncreaseFunc() {
                if(!this.hasPriceIncrease) {
                    this.fields.price = null
                } else {
                    this.fields.priceIncrease = null
                }
            },
            getAllConfigurators: function() {
                axios.get('/api/get/configurators')
                    .then(response => {
                        this.configurators = response.data
                    }).catch(err => {
                    console.log(err)
                });
            },
            onThumbnailChanged (event) {
                const file = event.target.files[0];
                this.fields.thumbnail = file;
                this.fields.thumbnailPreview = URL.createObjectURL(file);
            },
            onVisualisationChanged(event) {
                this.fields.visualisation = event.target.files[0]
            },
            getManufacturers: function() {
                axios.get('/api/get/manufacturers')
                    .then(response => {
                        this.manufacturers = response.data
                    }).catch(err => {
                    console.log("There has been an error getting all manufacturers")
                });
            },
            getSteps: function() {
                axios.get('/api/get/steps')
                    .then(response => {
                        this.steps = response.data
                    }).catch(err => {
                    console.log("There has been an error getting all manufacturers")
                });
            },
            submitProductCreateForm: function() {
                this.submitted = true
                this.$v.$touch()

                if(this.$v.$error) {
                    return
                } else {
                    document.getElementById("productCreateForm").submit();
                }
            },
            getAllConfigurableProducts: function() {
                axios.get('/api/get/configurable_products')
                    .then(response => {
                        this.configurableProducts = response.data
                        this.loading = false
                    }).catch(err => {
                    console.log(err)
                });
            },
            isLetter: function(event) {
                event = (event) ? event : window.event;
                var charCode = (event.which) ? event.which : event.keyCode;
                if ((charCode > 31 && (charCode < 48 || charCode > 57))) {
                    event.preventDefault();
                } else {
                    return true;
                }
            }
        },
        validations: {
            fields: {
                name: {
                    required,
                    maxLength: maxLength(128)
                },
                price: {
                    required: requiredIf(function() {
                        return !this.fields.hasPriceIncrease
                    })
                },
                priceIncrease: {
                    required: requiredIf(function() {
                        return this.fields.hasPriceIncrease
                    })
                },
                percentageParentProduct: {
                    required: requiredIf(function() {
                        return this.fields.priceIncrease
                    })
                },
                configurator_id: {
                    required: requiredIf(function() {
                        return this.fields.isConfigurableProduct
                    })
                },
                stock: {
                    required
                },
                sku: {
                    required
                },
                newFrom: {
                    required: requiredIf(function() {
                        return this.fields.newTo
                    }),
                },
                newTo: {
                    required: requiredIf(function() {
                        return this.fields.newFrom
                    }),
                },
                manufacturer: {
                    required: requiredIf(function() {
                        return this.fields.hasManufacturer;
                    })
                },
                interactionType: {
                    required: requiredIf(function() {
                        return !this.fields.isConfigurableProduct
                    })
                }
            },

        }
    }
</script>
