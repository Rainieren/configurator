@extends('layouts.dashboard')

@section('content')
    <div class="border-b px-5 py-3 bg-white">
        <div class="flex">
            <div class="w-1/2 flex items-center">
                <p class="text-xl">Nieuw product aanmaken</p>
            </div>
        </div>
    </div>
    <div class="p-5">
        <form action="{{ route('storeProduct') }}" class="w-50 my-2">
            <div class="flex">
                <div class="w-4/12">
                    <p class="text-gray-800 font-medium text-lg">Name</p>
                </div>
                <div class="w-8/12">
                    <input name="name" id="name" type="text" class="p-2 border border-gray-500 rounded-md w-100 shadow-sm">
                </div>
            </div>
            <hr class="my-4">
            <div class="flex">
                <div class="w-4/12">
                    <p class="text-gray-800 font-medium text-lg">Configurable product</p>
                </div>
                <div class="w-8/12">
                    <fieldset>
                        <div class="mt-3 space-y-2">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="has_step" name="has_step" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="has_step" class="font-medium text-gray-700">This product is a configurable product</label>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>

            <hr class="my-4">
            <div class="flex">
                <div class="w-4/12">
                    <p class="text-gray-800 font-medium text-lg">Price</p>
                </div>
                <div class="w-8/12">
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                          <span class="text-gray-500 sm:text-sm">
                            €
                          </span>
                        </div>
                        <input type="text" name="price" id="price" class="block w-full pl-8 pr-2 py-2 border border-gray-300 rounded-md" placeholder="0.00">
                    </div>
                    <fieldset>
                        <div class="mt-3 space-y-2">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="price_increase" name="price_increase" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-200 rounded">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="comments" class="font-medium text-gray-700">This product has a price increase</label>
                                    <p class="text-gray-500">Select this option if the product should increase the price with a percentage</p>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <div class="my-3">
                        <label for="" class="font-medium text-gray-700">Percentage</label>
                        <input type="text" name="percentage" id="percentage" class="p-2 border border-gray-300 rounded-md w-100 shadow-sm" placeholder="" disabled>
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <div class="flex">
                <div class="w-4/12">
                    <p class="text-gray-800 font-medium text-lg">Stock</p>
                    <p class="text-gray-500">How much do you have in stock?</p>
                </div>
                <div class="w-8/12">
                    <input type="text" id="stock" name="stock" class="p-2 border border-gray-500 rounded-md w-100 shadow-sm">
                </div>
            </div>
            <hr class="my-4">
            <div class="flex">
                <div class="w-4/12">
                    <p class="text-gray-800 font-medium text-lg">Description</p>
                </div>
                <div class="w-8/12">
                    <textarea id="description" name="description" rows="5" class="p-2 shadow-sm block w-full border border-gray-300 rounded-md" placeholder="Write something beautiful"></textarea>
                </div>
            </div>
            <hr class="my-4">
            <div class="flex">
                <div class="w-4/12">
                    <p class="text-gray-800 font-medium text-lg">Thumbnail</p>
                </div>
                <div class="w-8/12">
                    <div>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="file-upload" class="relative cursor-pointer rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                        <span>Upload a file</span>
                                        <input id="file-upload" name="file-upload" type="file" class="sr-only">
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
            <div class="flex">
                <div class="w-4/12">
                    <p class="text-gray-800 font-medium text-lg">Visualisation</p>
                    <p class="text-gray-500">Upload a visualisation of the product</p>
                </div>
                <div class="w-8/12">
                    <div>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="file-upload" class="relative cursor-pointer rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                        <span>Upload a file</span>
                                        <input id="file-upload" name="file-upload" type="file" class="sr-only">
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
            <div class="flex">
                <div class="w-4/12">
                    <p class="text-gray-800 font-medium text-lg">Product attributes</p>
                    <p class="text-gray-500">These values are configured in centimeters. To change to another unit of measurement. Go to settings</p>
                </div>
                <div class="w-8/12">
                    <div class="mb-3">
                        <label for="" class="font-medium text-gray-700">Weight</label>
                        <input type="text" name="weight" id="weight" class="p-2 border border-gray-300 rounded-md w-100 shadow-sm" placeholder="">
                    </div>
                    <div class="mb-3">
                        <label for="" class="font-medium text-gray-700">Height</label>
                        <input type="text" name="height" id="height" class="p-2 border border-gray-300 rounded-md w-100 shadow-sm" placeholder="">
                    </div>
                    <div class="mb-3">
                        <label for="" class="font-medium text-gray-700">Length</label>
                        <input type="text" name="length" id="length" class="p-2 border border-gray-300 rounded-md w-100 shadow-sm" placeholder="">
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <div class="flex">
                <div class="w-4/12">
                    <p class="text-gray-800 font-medium text-lg">Set product as new from</p>
                </div>
                <div class="w-8/12">
                    <div class="flex">
                        <input type="date" name="new_from" id="new_from" class="p-2 border border-gray-300 rounded-md w-100 shadow-sm" placeholder="">
                        <div class="mx-3 flex items-center justify-center">
                            <p class="text-gray-900 font-medium">To</p>
                        </div>
                        <input type="date" name="new_to" id="new_to" class="p-2 border border-gray-300 rounded-md w-100 shadow-sm" placeholder="">
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <div class="flex">
                <div class="w-4/12">
                    <p class="text-gray-800 font-medium text-lg">Manufacturer</p>
                    <p class="text-gray-500">Who made the product?</p>
                </div>
                <div class="w-8/12">
                    <select type="text" name="manufacturer" id="manufacturer" class="p-2 border border-gray-500 rounded-md w-100 shadow-sm">
                        <option value="">Sony</option>
                        <option value="">LG</option>
                        <option value="">Samsung</option>
                    </select>
                    <fieldset>
                        <div class="mt-3 space-y-2">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="has_manufacturer" name="has_manufacturer" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="has_manufacturer" class="font-medium text-gray-700">This product does not have a manufacturer</label>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
            <hr class="my-4">
            <div class="flex">
                <div class="w-4/12">
                    <p class="text-gray-800 font-medium text-lg">Configuration type</p>
                    <p class="text-gray-500">How do you want user to interact with this product?</p>
                </div>
                <div class="w-8/12">
                    <fieldset>
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <input id="push_everything" name="push_notifications" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">

                                <label for="push_everything" class="ml-3 block text-sm font-medium text-gray-700">
                                    Card
                                </label>

                                <div>
                                    <p class="text-gray-400 text-sm font-medium m-0">The products are clickable using a card</p>
                                </div>

                            </div>
                            <div class="flex items-center">
                                <input id="push_email" name="push_notifications" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                <label for="push_email" class="ml-3 block text-sm font-medium text-gray-700">
                                    Input field
                                </label>
                                <p class="text-gray-400 text-sm font-medium m-0">The user can type in what they want</p>


                            </div>
                            <div class="my-3">
                                <label for="" class="font-medium text-gray-700">What type of input field?</label>
                                <select type="text" name="manufacturer" id="manufacturer" class="p-2 border border-gray-500 rounded-md w-100 shadow-sm">
                                    <option value="">Plain text</option>
                                    <option value="">Date</option>
                                    <option value="">Password</option>
                                </select>
                            </div>
                            <div class="flex items-center">
                                <input id="push_nothing" name="push_notifications" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                <label for="push_nothing" class="ml-3 block text-sm font-medium text-gray-700">
                                    Radio button
                                </label>
                                <p class="text-gray-400 text-sm font-medium m-0">The user can select what they want using rounded buttons</p>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
            <hr class="my-4">
            <div class="flex">
                <div class="w-4/12">
                    <p class="text-gray-800 font-medium text-lg">Step</p>
                    <p class="text-gray-500">To what step does this product belong to?</p>
                </div>
                <div class="w-8/12">

                    <select type="text" name="step" id="step" class="p-2 border border-gray-500 rounded-md w-100 shadow-sm">
                        <option value="">Colours (Radio buttons)</option>
                        <option value="">Sizes (Cards)</option>
                    </select>
                    <p class="font-medium text-red-500 my-2">This product can only be applied to steps that have products with the same configuration type! Please choose a step with where all the products are [variable] aswell.</p>
                    <p class="text-gray-400 my-2">If there are no steps with your chosen configuration you can create a new step. Or change the product configuration</p>
                </div>
            </div>


            <div class="flex float-right my-5 space-x-4">
                <a href="" class="bg-gray-300 rounded p-2 text-centet text-black hover:text-indigo-500 hover:no-underline transition">Cancel</a>
                <button type="submit" class="bg-indigo-500 rounded p-2 w-48 text-center text-white hover:no-underline hover:bg-indigo-700 transition">Create product</button>
            </div>
        </form>
    </div>
@endsection
