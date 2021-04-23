@extends('layouts.dashboard')

@section('content')
    <div class="border-b px-5 py-3 bg-white">
        <div class="flex">
            <div class="w-1/2 flex items-center">
                <p class="text-xl">{{ $product->name }}</p>
            </div>
        </div>
    </div>
    <div class="p-5">
        <div class="flex space-x-6">
            <div class="h-100 shadow-sm w-2/6 bg-white p-4">
                <p class="text-xl font-bold">{{ $product->name }}</p>
            </div>
            <div class="w-2/6 space-y-6">
                <p class="text-xl mb-3">This product is configurable with:</p>
                <div class="shadow">
                    <div class="relative bg-white h-100 w-100 rounded-md transition p-4">
                        <p class="text-xl mb-3">Step name</p>
                        <div class="space-y-6">
                            <div class="space-y-8">
                                <div class="relative bg-white h-100 w-100 rounded-md transition">
                                    <div class="grid grid-cols-6 gap-6 h-100">
                                        <div class="col-span-1 flex flex-column items-center">
                                            <img src="{{ $product->thumbnail }}" class="h-100 rounded" alt="">
                                        </div>
                                        <div class="col-span-3 flex flex-column ">
                                            <p class="m-0 font-bold">{{ $product->name }}</p>
                                            <p class="m-0 text-gray-500">{{ substr($product->description, 0, 64) }}</p>
                                        </div>
                                        <div class="col-span-1">
                                            <p class="font-bold mb-2">Price</p>
                                            <p class="text-md m-0">€ {{ $product->price }}</p>
                                        </div>
                                        <div class="col-span-1">
                                            <p class="font-bold mb-2">Action</p>
                                            <div class="flex space-x-4">
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
                                        </div>
                                    </div>
                                </div>
                                <div class="relative bg-white h-100 w-100 rounded-md transition">
                                    <div class="grid grid-cols-6 gap-6 h-100">
                                        <div class="col-span-1 flex flex-column items-center">
                                            <img src="{{ $product->thumbnail }}" class="h-100 rounded" alt="">
                                        </div>
                                        <div class="col-span-3 flex flex-column ">
                                            <p class="m-0 font-bold">{{ $product->name }}</p>
                                            <p class="m-0 text-gray-500">{{ substr($product->description, 0, 64) }}</p>
                                        </div>
                                        <div class="col-span-1">
                                            <p class="font-bold mb-2">Price</p>
                                            <p class="text-md m-0">€ {{ $product->price }}</p>
                                        </div>
                                        <div class="col-span-1">
                                            <p class="font-bold mb-2">Action</p>
                                            <div class="flex space-x-4">
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
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="">
                                <a href="">
                                    <div class="border-2 border-dashed border-gray-400 hover:border-indigo-500 hover:text-indigo-500 w-100 p-2 cursor-pointer  flex-column rounded-md flex justify-center items-center transition">
                                        <p>Add product</p>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                    </div>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="">
                    <a href="">
                        <div class="border-2 border-dashed border-gray-400 hover:border-indigo-500 hover:text-indigo-500 h-56 w-100  flex-column rounded-md flex justify-center items-center transition">
                            <p>Add a step</p>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </div>
                    </a>
                </div>

            </div>

        </div>
    </div>
@endsection
