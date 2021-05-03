@extends('layouts.dashboard')

@section('content')
    <div class="border-b px-5 py-3 bg-white">
        <div class="flex">
            <div class="w-1/2 flex items-center">
                <p class="text-xl font-medium">Configurator</p>
            </div>
        </div>
    </div>
    <div class="p-5">
        <p class="text-xl">Add products you'd like to configure</p>
        <div class="grid gap-5 my-5 xl:grid-cols-3 lg:grid-cols-2 md:grid-cols-1">
            <div class="border-white bg-white shadow-sm min-h-56 w-100 rounded-md transition">
                <div class="px-5 py-3 border-b border-gray-200">
                    <div class="flex">
                        <div class="w-1/2">
                            <p class="font-bold m-0">Product name</p>
                            <p class="m-0">Omschrijving van prodcut</p>
                        </div>
                        <div class="w-1/2 text-right space-y-3">
                            <div class="flex space-x-4 justify-end">
                                <a href="" class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </a>
                                <a href="" class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </a>
                            </div>

                            <p class="text-md">€ -</p>
                        </div>
                    </div>
                </div>
                <div class="px-5 py-3 flex justify-center">
                    <div class="h-36 w-1/2 block bg-gray-300"></div>
                </div>
                <div class="px-5 py-3">
                    <p class="text-gray-500 m-0">Attributen 1</p>
                    <p class="text-gray-500 m-0">Attributen 2</p>
                </div>
            </div>
            <a href="" class="text-gray-400">
                <div class="border-2 border-dashed border-gray-400 hover:border-indigo-500 hover:text-indigo-500 h-100 w-100  rounded-md flex justify-center items-center transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                </div>
            </a>
        </div>

    </div>
@endsection
